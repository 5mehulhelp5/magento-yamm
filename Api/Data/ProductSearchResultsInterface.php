<?php

namespace Mageserv\Yamm\Api\Data;

/**
 * @api
 * @since 100.0.2
 */
interface ProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return \Mageserv\Yamm\Api\Data\ProductInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \Mageserv\Yamm\Api\Data\ProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
