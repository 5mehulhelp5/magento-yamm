<?php

namespace Mageserv\Yamm\Api\Data;
interface OrderStatusInterface
{
    const ID = 'id';
    const STATE = 'state';
    const STATUS = 'status';
    const STATUS_LABEL = 'status_label';

    /**
     * Get the order state
     *
     * @return int
     */
    public function getId();
    /**
     * Get the order state
     *
     * @return string
     */
    public function getState();

    /**
     * Set the order id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set the order state
     *
     * @param string $state
     * @return $this
     */
    public function setState($state);

    /**
     * Get the order status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set the order status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get the order status label
     *
     * @return string
     */
    public function getStatusLabel();

    /**
     * Set the order status label
     *
     * @param string $statusLabel
     * @return $this
     */
    public function setStatusLabel($statusLabel);
}
