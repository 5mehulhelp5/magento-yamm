<?php

namespace Mageserv\Yamm\Model;

use Magento\Framework\Model\AbstractModel;
use Mageserv\Yamm\Model\ResourceModel\Refund as ResourceModel;

class Refund extends AbstractModel
{
    const UNDER_REFUND_BY_YAMM = "yamm_under_refund";
    const REFUNDED_BY_YAMM = "yamm_refunded";
    const PARTIAL_REFUND_BY_YAMM = "yamm_partially_refunded";
    const REFUND_REJECTED_BY_YAMM = "yamm_refund_rejected";
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_refunds_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
