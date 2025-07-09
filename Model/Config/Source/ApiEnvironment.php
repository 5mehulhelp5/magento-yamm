<?php

namespace Mageserv\Yamm\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ApiEnvironment implements OptionSourceInterface
{

    const SANDBOX_ENVIRONMENT = "sandbox";
    const PRODUCTION_ENVIRONMENT = "production";

    public function toOptionArray()
    {
        return [
            [
                'value' => self::SANDBOX_ENVIRONMENT,
                'label' => __('Sandbox')
            ],
            [
                'value' => self::PRODUCTION_ENVIRONMENT,
                'label' => __('Production')
            ],
        ];
    }
}
