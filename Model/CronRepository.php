<?php
/**
 * CronRepository
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model;


use Mageserv\Yamm\Api\CronRepositoryInterface;
use Mageserv\Yamm\Api\Data\CronItemInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Mageserv\Yamm\Model\Config\Source\Status;

class CronRepository implements CronRepositoryInterface
{
    protected $cronFactory;
    protected $resource;
    protected $eventManager;
    protected $dataObjectProcessor;
    protected $instances = [];

    public function __construct(
        \Mageserv\Yamm\Model\CronFactory                  $cronFactory,
        \Mageserv\Yamm\Model\ResourceModel\Cron           $resource,
        \Magento\Framework\Event\ManagerInterface         $eventManager,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
    )
    {
        $this->cronFactory = $cronFactory;
        $this->resource = $resource;
        $this->eventManager = $eventManager;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Create or update cron item.
     *
     * @param \Mageserv\Yamm\Api\Data\CronItemInterface $cronItem
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\State\InputMismatchException If Entity already exist
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Mageserv\Yamm\Api\Data\CronItemInterface $cronItem)
    {
        /** @var Cron $task */
        $cronData = $this->dataObjectProcessor->buildOutputDataArray($cronItem, CronItemInterface::class);
        $task = $this->cronFactory->create();
        if ($cronItem->getQueueId()) {
            $task = $this->getById($cronItem->getQueueId());
        }
        $task->setData($cronData);
        $this->resource->save($task);
        unset($this->instances[$task->getQueueId()]);
        return $this->getById($task->getQueueId());
    }

    /**
     * Retrieve list of cron schedules by type.
     *
     * @param string $type
     * @param array|int $status
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByType($type, $status = [Status::PENDING])
    {
        if (!is_array($status)) $status = [$status];
        /** @var \Mageserv\Yamm\Model\ResourceModel\Cron\Collection $collection */
        $collection = $this->cronFactory->create()->getCollection();
        $collection->addFieldToFilter('event_type', [
            'like' => $type . '.%'
        ])->addFieldToFilter('status', ['in' => $status])->setOrder('created_at', 'ASC');
        $collection->setPageSize(5)->setCurPage(1);
        return $collection->getItems();
    }

    /**
     * Get cron schedule by ID
     *
     * @param int $taskId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($taskId)
    {
        $task = $this->cronFactory->create()->load($taskId);
        if (!$task->getQueueId()) {
            throw NoSuchEntityException::singleField('taskId', $taskId);
        }
        return $task;
    }

    /**
     * Delete Cron Schedule.
     *
     * @param \Mageserv\Yamm\Api\Data\CronItemInterface $task
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    public function delete(\Mageserv\Yamm\Api\Data\CronItemInterface $task)
    {
        $this->resource->delete($task);
        return true;
    }

    /**
     * Delete task by task ID.
     *
     * @param int $taskId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    public function deleteById($taskId)
    {
        $task = $this->cronFactory->create()->load($taskId);
        if (!$task->getQueueId()) {
            throw NoSuchEntityException::singleField('taskId', $taskId);
        }
        $task->delete();
        return true;
    }

    /**
     * @param string $eventType
     * @param string $entityId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCronByEntityId($eventType, $entityId)
    {
        $collection = $this->cronFactory->create()->getCollection();
        $collection->addFieldToFilter('event_type', $eventType)->addFieldToFilter('entity_id', $entityId);
        $collection->setPageSize(1)->setCurPage(1);
        if (!$collection->getSize())
            throw NoSuchEntityException::doubleField('eventType', $eventType, 'entityId', $entityId);
        return $collection->getFirstItem();
    }

    /**
     * @param string $eventType
     * @param string $entityId
     * @return \Mageserv\Yamm\Api\Data\CronItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function createOrUpdateCron($eventType, $entityId)
    {
        try {
            $task = $this->getCronByEntityId($eventType, $entityId);
        } catch (\Exception $exception) {
            $task = $this->cronFactory->create();
            $task->setEventType($eventType)
                ->setEntityId($entityId)
                ->setStatus(Status::PENDING)
                ->setErrorMessage("");
        }

        if ($task->getStatus() == Status::FAILED) {
            $task->setErrorMessage("")
                ->setStatus(Status::PENDING);
        }
        $this->save($task);
        return $task;
    }
}
