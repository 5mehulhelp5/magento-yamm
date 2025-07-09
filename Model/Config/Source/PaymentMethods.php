<?php
/**
 * PaymentMethods
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source;


use Magento\Framework\Data\OptionSourceInterface;
use Magento\Payment\Model\Config;

class PaymentMethods implements OptionSourceInterface
{
    protected $paymentConfig;

    public function __construct(Config $paymentConfig)
    {
        $this->paymentConfig = $paymentConfig;
    }

    public function toOptionArray()
    {
        $options = [];
        $methods = $this->paymentConfig->getActiveMethods();
        foreach ($methods as $method) {
            $options[] = [
                'value' => $method->getCode(),
                'label' => $method->getTitle(),
            ];
        }
        return $options;
    }
}
