<?php
/**
 * Order
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;


use Mageserv\Yamm\Api\Data\OrderInterface;
use Magento\Framework\DataObject;

class Order extends \Magento\Sales\Model\Order implements OrderInterface
{
    /**
     * @inheritdoc
     */
    public function getOrderId()
    {
        return $this->_getData(self::ORDER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritdoc
     */
    public function getReferenceId()
    {
        return $this->_getData(self::REFERENCE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setReferenceId($referenceId)
    {
        return $this->setData(self::REFERENCE_ID, $referenceId);
    }

    /**
     * @inheritdoc
     */
    public function getCustomer()
    {
        return $this->_getData(self::CUSTOMER);
    }

    /**
     * @inheritdoc
     */
    public function setCustomer($customer)
    {
        return $this->setData(self::CUSTOMER, $customer);
    }

    /**
     * @inheritdoc
     */
    public function getDate()
    {
        return $this->_getData(self::DATE);
    }

    /**
     * @inheritdoc
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }

    /**
     * @inheritdoc
     */
    public function getFirstCompleteAt()
    {
        return $this->_getData(self::FIRST_COMPLETE_AT);
    }

    /**
     * @inheritdoc
     */
    public function setFirstCompleteAt($firstCompleteAt)
    {
        return $this->setData(self::FIRST_COMPLETE_AT, $firstCompleteAt);
    }

    /**
     * @inheritdoc
     */
    public function getOrderStatus()
    {
        return $this->_getData(self::ORDER_STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setOrderStatus($orderStatus)
    {
        return $this->setData(self::ORDER_STATUS, $orderStatus);
    }

    /**
     * @inheritdoc
     */
    public function getOrderState()
    {
        return $this->_getData(self::ORDER_STATE);
    }

    /**
     * @inheritdoc
     */
    public function setOrderState($orderState)
    {
        return $this->setData(self::ORDER_STATE, $orderState);
    }

    /**
     * @inheritdoc
     */
    public function getPaymentMethod()
    {
        return $this->_getData(self::PAYMENT_METHOD);
    }

    /**
     * @inheritdoc
     */
    public function setPaymentMethod($paymentMethod)
    {
        return $this->setData(self::PAYMENT_METHOD, $paymentMethod);
    }

    /**
     * @inheritdoc
     */
    public function getOrderCurrency()
    {
        return $this->_getData(self::ORDER_CURRENCY);
    }

    /**
     * @inheritdoc
     */
    public function setOrderCurrency($orderCurrency)
    {
        return $this->setData(self::ORDER_CURRENCY, $orderCurrency);
    }

    /**
     * @inheritdoc
     */
    public function getAmounts()
    {
        return $this->_getData(self::AMOUNTS);
    }

    /**
     * @inheritdoc
     */
    public function setAmounts($amounts)
    {
        return $this->setData(self::AMOUNTS, $amounts);
    }

    /**
     * @inheritdoc
     */
    public function getShipping()
    {
        return $this->_getData(self::SHIPPING);
    }

    /**
     * @inheritdoc
     */
    public function setShipping($shipping)
    {
        return $this->setData(self::SHIPPING, $shipping);
    }

    /**
     * @inheritdoc
     */
    public function getCanCancel()
    {
        return $this->_getData(self::CAN_CANCEL);
    }

    /**
     * @inheritdoc
     */
    public function setCanCancel($canCancel)
    {
        return $this->setData(self::CAN_CANCEL, $canCancel);
    }

    /**
     * @inheritdoc
     */
    public function getShowWeight()
    {
        return $this->_getData(self::SHOW_WEIGHT);
    }

    /**
     * @inheritdoc
     */
    public function setShowWeight($showWeight)
    {
        return $this->setData(self::SHOW_WEIGHT, $showWeight);
    }

    /**
     * @inheritdoc
     */
    public function getCanReorder()
    {
        return $this->_getData(self::CAN_REORDER);
    }

    /**
     * @inheritdoc
     */
    public function setCanReorder($canReorder)
    {
        return $this->setData(self::CAN_REORDER, $canReorder);
    }

    /**
     * @inheritdoc
     */
    public function getIsPendingPayment()
    {
        return $this->_getData(self::IS_PENDING_PAYMENT);
    }

    /**
     * @inheritdoc
     */
    public function setIsPendingPayment($isPendingPayment)
    {
        return $this->setData(self::IS_PENDING_PAYMENT, $isPendingPayment);
    }

    /**
     * @inheritdoc
     */
    public function getPendingPaymentEndsAt()
    {
        return $this->_getData(self::PENDING_PAYMENT_ENDS_AT);
    }

    /**
     * @inheritdoc
     */
    public function setPendingPaymentEndsAt($pendingPaymentEndsAt)
    {
        return $this->setData(self::PENDING_PAYMENT_ENDS_AT, $pendingPaymentEndsAt);
    }

    /**
     * @inheritdoc
     */
    public function getTotalWeight()
    {
        return $this->_getData(self::TOTAL_WEIGHT);
    }

    /**
     * @inheritdoc
     */
    public function setTotalWeight($totalWeight)
    {
        return $this->setData(self::TOTAL_WEIGHT, $totalWeight);
    }

    /**
     * @inheritdoc
     */
    public function getProducts()
    {
        return $this->_getData(self::PRODUCTS);
    }

    /**
     * @inheritdoc
     */
    public function setProducts($products)
    {
        return $this->setData(self::PRODUCTS, $products);
    }

    /**
     * @inheritdoc
     */
    public function getPhoneNumber()
    {
        return $this->_getData(self::PHONE_NUMBER);
    }

    /**
     * @inheritdoc
     */
    public function setPhoneNumber($phoneNumber)
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * @inheritdoc
     */
    public function getIsPaymentMethodAllowed()
    {
        return $this->_getData(self::IS_PAYMENT_METHOD_ALLOWED);
    }

    /**
     * @inheritdoc
     */
    public function setIsPaymentMethodAllowed($isAllowed)
    {
        return $this->setData(self::IS_PAYMENT_METHOD_ALLOWED, $isAllowed);
    }

}
