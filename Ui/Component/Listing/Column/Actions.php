<?php
/**
 * Actions
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Actions constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [],
        array              $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);

        $this->urlBuilder = $urlBuilder;
    }

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
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'view' => [
                        'label' => __('View')
                    ],
                    'reschedule' => [
                        'href' => $this->urlBuilder->getUrl('yamm/log/reschedule', ['queue_id' => $item['queue_id']]),
                        'label' => __('Reschedule'),
                        'confirm' => [
                            'title' => __('Reschedule Item?'),
                            'message' => __(
                                'Are you sure you want to reschedule this item?'
                            )
                        ]
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl('yamm/log/delete', ['queue_id' => $item['queue_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete Log'),
                            'message' => __('Are you sure you want to delete this log?')
                        ]
                    ],
                ];
            }
        }

        return $dataSource;
    }
}
