<?php
/**
 * AddressAttributes
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source;


use Magento\Framework\Data\OptionSourceInterface;
use Magento\Eav\Model\Config;
class AddressAttributes implements OptionSourceInterface
{
    protected $eavConfig;
    public function __construct(
        Config $eavConfig
    )
    {
        $this->eavConfig = $eavConfig;
    }

    public function toOptionArray()
    {
        $entityType = $this->eavConfig->getEntityType("customer_address");
        return $entityType->getAttributeCollection()->toOptionArray();
    }
}
