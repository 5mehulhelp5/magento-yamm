<?php

namespace Mageserv\Yamm\Model;

use Magento\Framework\Model\AbstractModel;
use Mageserv\Yamm\Api\Data\CronItemInterface;
use Mageserv\Yamm\Model\Config\Source\Status;
use Mageserv\Yamm\Model\ResourceModel\Cron as ResourceModel;

class Cron extends AbstractModel implements CronItemInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'yamm_schedule_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
    public function reschedule()
    {
        $this->setStatus(Status::PENDING)->setErrorMessage("");
        $this->_resource->save($this);
        return true;
    }
    /**
     * @return int
     */
    public function getQueueId()
    {
        return $this->getData(self::QUEUE_ID);
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @return string|null
     */
    public function getEventType()
    {
        return $this->getData(self::EVENT_TYPE);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @return string|null
     */
    public function getErrorMessage()
    {
        return $this->getData(self::ERROR_MESSAGE);
    }

    /**
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @return string|null
     */
    public function getProcessedAt()
    {
        return $this->getData(self::PROCESSED_AT);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setQueueId($id)
    {
        $this->setData(self::QUEUE_ID, $id);
        return $this;
    }

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
        return $this;
    }

    /**
     * @param string $eventType
     * @return $this
     */
    public function setEventType($eventType)
    {
        $this->setData(self::EVENT_TYPE, $eventType);
        return $this;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setErrorMessage($message)
    {
        $this->setData(self::ERROR_MESSAGE, $message);
        return $this;
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
        return $this;
    }

    /**
     * @param string $processedAt
     * @return $this
     */
    public function setProcessedAt($processedAt)
    {
        $this->setData(self::PROCESSED_AT, $processedAt);
        return $this;
    }

}
