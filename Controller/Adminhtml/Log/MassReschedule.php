<?php
/**
 * MassReschedule
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Log;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Mageserv\Yamm\Model\ResourceModel\Cron\CollectionFactory;

class MassReschedule extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $cronLog;


    public function __construct(
        Filter $filter,
        Context $context,
        CollectionFactory $cronLog
    ) {
        $this->filter   = $filter;
        $this->cronLog = $cronLog;

        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->cronLog->create());
        $rescheduled     = 0;

        /** @var \Mageserv\Yamm\Model\Cron $item */
        foreach ($collection->getItems() as $item) {
            if ($item->reschedule()) {
                $rescheduled++;
            } else {
                $this->messageManager->addErrorMessage(
                    __('We can\'t process your request for cron log #%1', $item->geQueueId())
                );
            }
        }

        if ($rescheduled) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been rescheduled.', $rescheduled)
            );
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*');
    }
}
