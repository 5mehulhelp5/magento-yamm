<?php
/**
 * AbstractCron
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Cron;


use Laminas\Http\Request;
use Laminas\Http\Response;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Sales\Api\OrderRepositoryInterface;
use Mageserv\Yamm\Api\CatalogManagementInterface;
use Mageserv\Yamm\Api\CronRepositoryInterface;
use Mageserv\Yamm\Api\Data\CronItemInterface;
use Mageserv\Yamm\Api\Data\ResponseInterface;
use Mageserv\Yamm\Api\Data\ResponseInterfaceFactory;
use Mageserv\Yamm\Helper\Yamm;
use Mageserv\Yamm\Model\Config\Source\Status;
use Mageserv\Yamm\Model\Config\Source\TriggerEvents\Options;
use Psr\Log\LoggerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

class Cron
{
    protected $_entityType;
    protected $deleteEvent;
    protected $retrieveMethod = 'getById';
    /**
     * @var CronRepositoryInterface
     */
    protected $cronRepository;
    /**
     * @var Yamm
     */
    protected $yammHelper;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var CustomerRepositoryInterface | ProductRepositoryInterface | CategoryRepositoryInterface | OrderRepositoryInterface
     */
    protected $entityRepository;
    protected $dataObjectProcessor;
    protected $responseInterfaceFactory;
    protected $objectManager;
    protected $cached = [];

    public function __construct(
        CronRepositoryInterface  $cronRepository,
        Yamm                     $yammHelper,
        LoggerInterface          $logger,
        DataObjectProcessor      $dataObjectProcessor,
        ResponseInterfaceFactory $responseInterfaceFactory,
        ObjectManager            $objectManager,
                                 $entityRepository,
                                 $entityType,
                                 $deleteEvent,
                                 $retrieveMethod = null
    )
    {
        $this->cronRepository = $cronRepository;
        $this->yammHelper = $yammHelper;
        $this->logger = $logger;
        if (is_array($entityRepository)) {
            $this->entityRepository = ObjectManager::getInstance()->create($entityRepository['instance']);
        } else {
            $this->entityRepository = $entityRepository;
        }
        $this->_entityType = $entityType;
        $this->deleteEvent = $deleteEvent;
        if ($retrieveMethod)
            $this->retrieveMethod = $retrieveMethod;

        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->responseInterfaceFactory = $responseInterfaceFactory;
        $this->objectManager = $objectManager;
    }

    public function execute()
    {
        $tasks = $this->getQueue();
        foreach ($tasks as $task) {
            $this->syncYamm($task);
        }
    }

    public function syncYamm($task, $forceSync = 0)
    {
        if ($task->getStatus() == Status::SUCCESS && !$forceSync) return;
        $response = $this->yammHelper->syncData($this->processQueue($task)->getData());
        $this->handleResponse($task, $response);
    }

    protected function getQueue()
    {
        return $this->cronRepository->getByType($this->_entityType, Status::PENDING);
    }

    /**
     * @param CronItemInterface $entityId
     * @return ResponseInterface
     */
    protected function processQueue(CronItemInterface $task)
    {
        /** @var ResponseInterface $transaction */
        $transaction = $this->responseInterfaceFactory->create();
        $transaction->setEventType($task->getEventType());
        if ($task->getEventType() != $this->deleteEvent) {
            if (empty($this->cached[$this->_entityType]) && empty($this->cached[$this->_entityType][$task->getEntityId()])) {
                try {
                    $entity = $this->getEntityById($task->getEntityId(), $this->_entityType);
                    if ($entity instanceof DataObject) {
                        $modelData = $entity->getData();
                    } else {
                        $modelData = $this->dataObjectProcessor->buildOutputDataArray($entity, get_class($entity));
                    }
                    $data = $this->cached[$this->_entityType][$task->getEntityId()] = $modelData;
                } catch (\Exception $exception) {
                    // entity got deleted before queue process
                    $this->haltTask($task, $exception->getMessage());
                }
            } else {
                $data = $this->cached[$this->_entityType][$task->getEntityId()];
            }
        } else {
            $data = [
                'entity_id' => $task->getEntityId()
            ];
        }
        $transaction->setEventData($data);
        return $transaction;
    }

    /**
     * @param CronItemInterface $task
     * @param $response
     * @return void
     */
    protected function handleResponse($task, $response)
    {
        if ($this->yammHelper->isLogEnabled()) {
            $this->logger->info("Task " . $task->getQueueId() . "=>" . $response);
        }
        if (is_array($response) && !empty($response['status_code'])) {
            if (strpos($response['status_code'], '2') === 0) {
                $task->setStatus(Status::SUCCESS)
                    ->setErrorMessage("");
            } else {
                $task->setStatus(Status::FAILED);
                if (!empty($response['body']['errors']) && !empty($response['body']['errors'][0]['message'])) {
                    $task->setErrorMessage($response['errors'][0]['message']);
                }
            }
        } else {
            $task->setStatus(Status::FAILED)
                ->setErrorMessage(__("Unknown Error Happened"));
        }
        $this->cronRepository->save($task);
    }

    protected function haltTask(CronItemInterface $task, $message)
    {
        $task->setStatus(Status::FAILED)->setErrorMessage($message);
        $this->cronRepository->save($task);
    }

    private function getEntityById($id, $entityType)
    {
        switch ($entityType) {
            case 'catalog_product':
                return $this->objectManager->create(CatalogManagementInterface::class)->getById($id);
            case 'catalog_category':
                return $this->objectManager->create(\Mageserv\Yamm\Api\CategoryRepositoryInterface::class)->getCategoriesTree($id);
            case 'customer':
                return $this->objectManager->create(\Mageserv\Yamm\Api\CustomerRepositoryInterface::class)->getById($id);
            case 'order':
                return $this->objectManager->create(\Mageserv\Yamm\Api\OrderRepositoryInterface::class)->get($id);
        }
    }
}
