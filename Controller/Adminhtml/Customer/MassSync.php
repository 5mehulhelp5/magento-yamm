<?php
/**
 * MassSync
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Customer;


use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Mageserv\Yamm\Api\CronRepositoryInterface;
use Mageserv\Yamm\Model\Config\Source\CronType;
use Mageserv\Yamm\Model\Config\Source\TriggerEvents\Options;

class MassSync extends \Magento\Customer\Controller\Adminhtml\Index\AbstractMassAction implements HttpPostActionInterface
{
    /**
     * @var CronRepositoryInterface
     */
    protected $cronRepositoryInterface;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param CronRepositoryInterface $customerRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CronRepositoryInterface $cronRepositoryInterface
    ) {
        parent::__construct($context, $filter, $collectionFactory);
        $this->cronRepositoryInterface = $cronRepositoryInterface;
    }

    /**
     * Execute action to collection items
     *
     * @param AbstractCollection $collection
     * @return ResponseInterface|ResultInterface
     */
    protected function massAction(AbstractCollection $collection)
    {
        $customersSynced = 0;
        foreach ($collection->getAllIds() as $customerId) {
            $this->cronRepositoryInterface->createOrUpdateCron(Options::UPDATE_CUSTOMER, $customerId);
            $customersSynced++;
        }

        if ($customersSynced) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were added to sync queue.', $customersSynced));
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
