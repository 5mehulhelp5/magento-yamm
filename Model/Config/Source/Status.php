<?php
/**
 * Status
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source;


class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    const PENDING   =   0;
    const SUCCESS   =   1;
    const FAILED    =   2;

    public function toOptionArray()
    {
        $options = array();
        foreach (self::getOptions() as $value => $label) {
            $options[] = array(
                'value'    => $value,
                'label'    => $label
            );
        }
        return $options;
    }
    public static function getOptions()
    {
        return [
            self::PENDING =>    __('Pending'),
            self::SUCCESS =>    __('Success'),
            self::FAILED =>     __('Failed')
        ];
    }
}
