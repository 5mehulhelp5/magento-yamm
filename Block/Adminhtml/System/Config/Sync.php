<?php
/**
 * Sync
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Block\Adminhtml\System\Config;


use Mageserv\Yamm\Model\Config\Source\CronType;

class Sync extends Button
{
    /**
     * @var string
     */
    protected $_template = 'Mageserv_Yamm::system/config/sync-template.phtml';

    /**
     * @return string
     */
    public function getEstimateUrl()
    {
        return $this->getUrl('yamm/connection/estimate', ['_current' => true]);
    }

    /**
     * @return mixed
     */
    public function getWebsiteId()
    {
        return $this->getRequest()->getParam('website');
    }

    /**
     * @return mixed
     */
    public function getStoreId()
    {
        return $this->getRequest()->getParam('store');
    }

    /**
     * @return array
     */
    public function getSyncSuccessMessage()
    {
        return [
            CronType::CUSTOMER   => __('Customer synchronization has been completed.'),
            CronType::ORDER      => __('Order synchronization has been completed.'),
            CronType::PRODUCT   => __('Product synchronization has been completed.'),
            CronType::CATEGORY   => __('Category synchronization has been completed.')
        ];
    }

    /**
     * @return string
     */
    public function getElementId()
    {
        return 'yamm-synchronize';
    }

    /**
     * @return string
     */
    public function getComponent()
    {
        return 'Mageserv_Yamm/js/sync/sync';
    }
}
