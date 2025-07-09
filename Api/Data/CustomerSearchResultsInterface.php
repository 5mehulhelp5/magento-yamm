<?php

namespace Mageserv\Yamm\Api\Data;

interface CustomerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get customers list.
     *
     * @return \Mageserv\Yamm\Api\Data\CustomerInterface[]
     */
    public function getItems();

    /**
     * Set customers list.
     *
     * @param \Mageserv\Yamm\Api\Data\CustomerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
