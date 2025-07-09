<?php

namespace Mageserv\Yamm\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CatalogManagementInterface
{
    /**
     * Get product list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mageserv\Yamm\Api\Data\ProductSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Get product list
     *
     * @param string $sku
     * @return \Mageserv\Yamm\Api\Data\ProductInterface
     */
    public function get($sku);
}
