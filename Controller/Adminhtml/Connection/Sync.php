<?php
/**
 * Sync
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Connection;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Mageserv\Yamm\Api\CronRepositoryInterface;
use Mageserv\Yamm\Helper\Data;

class Sync extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mageserv_Yamm::configuration';
    protected $cronRepository;
    public function __construct(
        Context $context,
        CronRepositoryInterface $cronRepository
    )
    {
        parent::__construct($context);
        $this->cronRepository = $cronRepository;
    }

    public function execute()
    {
        $result      = [];
        try{
            $type        = $this->getRequest()->getParam('type');
            $ids = $this->getRequest()->getParam('ids');
            $total = 0;
            foreach ($ids as $itemId) {
                $eventType = $type . ".create";
                $this->cronRepository->createOrUpdateCron($eventType, $itemId);
                $total++;
            }
            $result['success'] = true;
            $result['total'] = $total;
            $result['log'] = __("%1 records has been added to schedule", $total);
        }catch (\Exception $exception){
            $result['success'] = false;
            $result['message'] = $exception->getMessage();
        }
        return $this->getResponse()->representJson(Data::jsonEncode($result));
    }
}
