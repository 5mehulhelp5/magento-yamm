<?php
/**
 * MethodsManagement
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model;


use Mageserv\Yamm\Api\MethodsManagementInterface;
use Magento\Payment\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Shipping\Model\Config as ShippingConfig;

class MethodsManagement implements MethodsManagementInterface
{
    protected $paymentConfig;
    protected $shippingConfig;
    protected $scopeConfig;
    protected $paymentMethodInterfaceFactory;

    public function __construct(
        Config $paymentConfig,
        ScopeConfigInterface $scopeConfig,
        \Mageserv\Yamm\Api\Data\MethodInterfaceFactory $paymentMethodInterfaceFactory,
        ShippingConfig $shippingConfig
    ) {
        $this->paymentConfig = $paymentConfig;
        $this->shippingConfig = $shippingConfig;
        $this->scopeConfig = $scopeConfig;
        $this->paymentMethodInterfaceFactory = $paymentMethodInterfaceFactory;
    }
    /**
     * @inheritDoc
     */
    public function getPaymentMethods()
    {
        $methods = $this->paymentConfig->getActiveMethods();
        $result = [];

        foreach ($methods as $code => $method) {
            $title = $this->scopeConfig->getValue(
                "payment/{$code}/title",
                ScopeInterface::SCOPE_STORE
            );
            $result[] = $this->paymentMethodInterfaceFactory->create(['data' => [
                'code' => $code,
                'title' => $title ?: $code
            ]]);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getShippingMethods()
    {
        $carriers = $this->shippingConfig->getAllCarriers();
        $result = [];

        foreach ($carriers as $code => $carrier) {
            $title = $this->scopeConfig->getValue(
                "carriers/{$code}/title",
                ScopeInterface::SCOPE_STORE
            );

            $result[] = $this->paymentMethodInterfaceFactory->create(['data' => [
                'code' => $code,
                'title' => $title ?: $code
            ]]);
        }

        return $result;
    }
}
