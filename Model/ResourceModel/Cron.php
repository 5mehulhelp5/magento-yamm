<?php

namespace Mageserv\Yamm\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Cron extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_schedule_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('yamm_schedule', 'queue_id');
        $this->_useIsObjectNew = true;
    }
}
