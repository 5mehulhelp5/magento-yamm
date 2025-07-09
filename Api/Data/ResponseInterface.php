<?php

namespace Mageserv\Yamm\Api\Data;


interface ResponseInterface
{
    const EVENT_TYPE = "event_type";
    const EVENT_DATA = "data";

    /**
     * @return string
     */
    public function getEventType();

    /**
     * @param string $eventType
     * @return $this
     */
    public function setEventType($eventType);

    /**
     * @return \Mageserv\Yamm\Api\Data\OrderInterface|\Magento\Catalog\Api\Data\ProductInterface|\Magento\Catalog\Api\Data\CategoryInterface
     */
    public function getEventData();

    /**
     * @param \Mageserv\Yamm\Api\Data\OrderInterface|\Magento\Catalog\Api\Data\ProductInterface|\Magento\Catalog\Api\Data\CategoryInterface $data
     * @return $this
     */
    public function setEventData($data);
}
