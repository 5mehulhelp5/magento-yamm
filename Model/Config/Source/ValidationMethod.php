<?php
/**
 * ValidationMethod
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source;


use Magento\Framework\Data\OptionSourceInterface;

class ValidationMethod implements OptionSourceInterface
{
    const VALIDATE_BY_EMAIL = "validate_by_email";
    const VALIDATE_BY_MOBILE_NUMBER = "validate_by_mobile";
    public function toOptionArray()
    {
        return [
            [
                'label' => __("Validate by Email"),
                'value' => self::VALIDATE_BY_EMAIL
            ],
            [
                'label' => __("Validate by Mobile Number"),
                'value' => self::VALIDATE_BY_MOBILE_NUMBER
            ],
        ];
    }
}
