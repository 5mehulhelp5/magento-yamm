<?php

namespace Mageserv\Yamm\Model\ResourceModel\Refund;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mageserv\Yamm\Model\Refund as Model;
use Mageserv\Yamm\Model\ResourceModel\Refund as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_refunds_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
