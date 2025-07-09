<?php
/**
 * MobileAttribute
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source;


use Magento\Framework\Data\OptionSourceInterface;

class MobileAttribute implements OptionSourceInterface
{
    const BILLING_ADDRESS_TELEPHONE = "billing_address_telephone";
    const SHIPPING_ADDRESS_TELEPHONE = "shipping_address_telephone";
    const ADDRESS_CUSTOM_ATTRIBUTE = "address_custom_attribute";
    public function toOptionArray()
    {
        return [
            [
                'label' => __("Billing Address Telephone"),
                'value' => self::BILLING_ADDRESS_TELEPHONE
            ],
            [
                'label' => __("Shipping Address Telephone"),
                'value' => self::SHIPPING_ADDRESS_TELEPHONE
            ],
            [
                'label' => __("Order Address Custom Attribute"),
                'value' => self::ADDRESS_CUSTOM_ATTRIBUTE
            ],
        ];
    }
}
