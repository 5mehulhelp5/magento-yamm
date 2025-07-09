<?php

namespace Mageserv\Yamm\Api\Data;

/**
 * Interface OrderInterface
 * @api
 */
interface OrderInterface extends \Magento\Sales\Api\Data\OrderInterface
{
    const ORDER_ID = 'order_id';
    const REFERENCE_ID = 'reference_id';
    const CUSTOMER = 'customer';
    const DATE = 'date';
    const FIRST_COMPLETE_AT = 'first_complete_at';
    const ORDER_STATUS = 'order_status';
    const PAYMENT_METHOD = 'payment_method';
    const ORDER_CURRENCY = 'order_currency';
    const AMOUNTS = 'amounts';
    const SHIPPING = 'shipping';
    const CAN_CANCEL = 'can_cancel';
    const SHOW_WEIGHT = 'show_weight';
    const CAN_REORDER = 'can_reorder';
    const IS_PENDING_PAYMENT = 'is_pending_payment';
    const PENDING_PAYMENT_ENDS_AT = 'pending_payment_ends_at';
    const TOTAL_WEIGHT = 'total_weight';
    const PRODUCTS = 'products';
    const PHONE_NUMBER = 'phone_number';
    const IS_PAYMENT_METHOD_ALLOWED = 'is_payment_method_allowed';
    const SHIPPING_ADDRESS = 'shipping_address';
    /**
     * @return int
     */
    public function getOrderId();

    /**
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * @return string
     */
    public function getReferenceId();

    /**
     * @param string $referenceId
     * @return $this
     */
    public function setReferenceId($referenceId);

    /**
     * @return \Mageserv\Yamm\Api\Data\CustomerInterface
     */
    public function getCustomer();

    /**
     * @param \Mageserv\Yamm\Api\Data\CustomerInterface $customer
     * @return $this
     */
    public function setCustomer($customer);

    /**
     * @return string
     */
    public function getDate();

    /**
     * @param string $date
     * @return $this
     */
    public function setDate($date);

    /**
     * @return string
     */
    public function getFirstCompleteAt();

    /**
     * @param string $firstCompleteAt
     * @return $this
     */
    public function setFirstCompleteAt($firstCompleteAt);

    /**
     * @return string
     */
    public function getOrderStatus();

    /**
     * @param string $orderStatus
     * @return $this
     */
    public function setOrderStatus($orderStatus);

    /**
     * @return string
     */
    public function getPaymentMethod();

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod($paymentMethod);

    /**
     * @return string
     */
    public function getOrderCurrency();

    /**
     * @param string $orderCurrency
     * @return $this
     */
    public function setOrderCurrency($orderCurrency);

    /**
     * @return float
     */
    public function getAmounts();

    /**
     * @param float $amounts
     * @return $this
     */
    public function setAmounts($amounts);

    /**
     * @return float
     */
    public function getShipping();

    /**
     * @param float $shipping
     * @return $this
     */
    public function setShipping($shipping);

    /**
     * @return bool
     */
    public function getCanCancel();

    /**
     * @param bool $canCancel
     * @return $this
     */
    public function setCanCancel($canCancel);

    /**
     * @return bool
     */
    public function getShowWeight();

    /**
     * @param bool $showWeight
     * @return $this
     */
    public function setShowWeight($showWeight);

    /**
     * @return bool
     */
    public function getCanReorder();

    /**
     * @param bool $canReorder
     * @return $this
     */
    public function setCanReorder($canReorder);

    /**
     * @return bool
     */
    public function getIsPendingPayment();

    /**
     * @param bool $isPendingPayment
     * @return $this
     */
    public function setIsPendingPayment($isPendingPayment);

    /**
     * @return string
     */
    public function getPendingPaymentEndsAt();

    /**
     * @param string $pendingPaymentEndsAt
     * @return $this
     */
    public function setPendingPaymentEndsAt($pendingPaymentEndsAt);

    /**
     * @return string
     */
    public function getTotalWeight();

    /**
     * @param string $totalWeight
     * @return $this
     */
    public function setTotalWeight($totalWeight);

    /**
     * @return \Mageserv\Yamm\Api\Data\OrderItemInterface[]
     */
    public function getProducts();

    /**
     * @param \Mageserv\Yamm\Api\Data\OrderItemInterface[] $products
     * @return $this
     */
    public function setProducts($products);

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * @return bool
     */
    public function getIsPaymentMethodAllowed();

    /**
     * @param bool $isAllowed
     * @return $this
     */
    public function setIsPaymentMethodAllowed($isAllowed);

    /**
     * @return \Mageserv\Yamm\Api\Data\ExtendedOrderItemInterface[]
     */
    public function getItems();

    /**
     * @param \Mageserv\Yamm\Api\Data\ExtendedOrderItemInterface[] $items
     * @return $this
     */
    public function setItems($items);
    /**
     * Gets the shipping address, if any, for the order.
     *
     * @return \Magento\Sales\Api\Data\OrderAddressInterface|null shipping address. Otherwise, null.
     */
    public function getShippingAddress();

    /**
     * Sets the shipping address, if any, for the order.
     *
     * @param \Magento\Sales\Api\Data\OrderAddressInterface $shippingAddress
     * @return $this
     */
    public function setShippingAddress(\Magento\Sales\Api\Data\OrderAddressInterface $shippingAddress = null);
}
