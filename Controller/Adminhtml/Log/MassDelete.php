<?php
/**
 * MassDelete
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Log;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Mageserv\Yamm\Model\ResourceModel\Cron\CollectionFactory;
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $cronLog;

    /**
     * MassDelete constructor.
     *
     * @param Filter $filter
     * @param Context $context
     * @param CollectionFactory $cronLog
     */
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
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $deleted    = 0;
        try {
            $collection = $this->filter->getCollection($this->cronLog->create());

            foreach ($collection->getItems() as $item) {
                $item->delete();
                $deleted++;
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(
                __('We can\'t process your request right now. %1', $e->getMessage())
            );
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $deleted)
        );

        return $resultRedirect->setPath('*/*');
    }
}
