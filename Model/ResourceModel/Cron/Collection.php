<?php

namespace Mageserv\Yamm\Model\ResourceModel\Cron;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mageserv\Yamm\Model\Config\Source\Status;
use Mageserv\Yamm\Model\Cron as Model;
use Mageserv\Yamm\Model\ResourceModel\Cron as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_schedule_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }

    public function clearLog()
    {
        $this->getConnection()->delete($this->getMainTable(), [
            'status IN (?)' => [Status::SUCCESS, Status::FAILED]
        ]);
    }
}
