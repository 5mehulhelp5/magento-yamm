<?php
/**
 * Reschedule
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Log;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Mageserv\Yamm\Model\Config\Source\Status;
use Mageserv\Yamm\Model\CronFactory;

class Reschedule extends Action
{
    /**
     * @var CronFactory
     */
    protected $cronFactory;

    /**
     * Delete constructor.
     *
     * @param Context $context
     * @param CronFactory $cronFactory
     */
    public function __construct(
        CronFactory $cronFactory,
        Context     $context
    )
    {
        parent::__construct($context);

        $this->cronFactory = $cronFactory;
    }

    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        try {
            $logId = $this->getRequest()->getParam('queue_id');
            $log = $this->cronFactory->create()->load($logId);
            $log->setStatus(Status::PENDING)->setErrorMessage("")->save();
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                __('We can\'t process your request right now. %1', $e->getMessage())
            );
            return $this->_redirect('*/*');
        }

        $this->messageManager->addSuccessMessage(
            __('A total of 1 record have been rescheduled.')
        );

        return $resultRedirect->setPath('*/*');
    }
}
