<?php

namespace Mageserv\Yamm\Api\Data;

interface CronItemInterface
{
    const QUEUE_ID      =   'queue_id';
    const ENTITY_ID     =   'entity_id';
    const EVENT_TYPE = 'event_type';
    const STATUS        =   'status';
    const ERROR_MESSAGE =   'error_message';
    const CREATED_AT    =   'created_at';
    const PROCESSED_AT  =   'processed_at';

    /**
     * @return int
     */
    public function getQueueId();

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @return string|null
     */
    public function getEventType();

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return string|null
     */
    public function getErrorMessage();

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @return string|null
     */
    public function getProcessedAt();

    /**
     * @param int $id
     * @return $this
     */
    public function setQueueId($id);

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * @param string $eventType
     * @return $this
     */
    public function setEventType($eventType);

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @param string $message
     * @return $this
     */
    public function setErrorMessage($message);

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @param string $processedAt
     * @return $this
     */
    public function setProcessedAt($processedAt);
}
