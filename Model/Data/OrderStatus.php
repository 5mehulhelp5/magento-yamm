<?php
/**
 * OrderStatus
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\OrderStatusInterface;

class OrderStatus extends DataObject implements OrderStatusInterface
{
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    } /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->_getData(self::STATE);
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusLabel()
    {
        return $this->_getData(self::STATUS_LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setStatusLabel($statusLabel)
    {
        return $this->setData(self::STATUS_LABEL, $statusLabel);
    }
}
