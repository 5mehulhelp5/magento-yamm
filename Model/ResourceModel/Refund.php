<?php

namespace Mageserv\Yamm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Refund extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_refunds_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('yamm_refunds', 'refund_id');
        $this->_useIsObjectNew = true;
    }
}
