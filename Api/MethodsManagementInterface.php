<?php

namespace Mageserv\Yamm\Api;

interface MethodsManagementInterface
{
    /**
     * Get available payment methods
     *
     * @return \Magento\Quote\Api\Data\PaymentMethodInterface[]
     */
    public function getPaymentMethods();
    /**
     * Get available shipping methods
     *
     * @return \Magento\Quote\Api\Data\PaymentMethodInterface[]
     */
    public function getShippingMethods();
}
