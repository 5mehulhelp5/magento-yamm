<?php
/**
 * Actions
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Ui\Component\Listing\Column\Refund;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Details extends Column
{

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['reference_id'])) {
                    $externalLink = "https://merchant.yammrefund.com/orders/" . $item['reference_id'];
                    $item[$fieldName] = '<a href="' . $externalLink . '" target="_blank">'. __('Details') .'</a>';
                }
            }
        }
        return $dataSource;
    }
}
