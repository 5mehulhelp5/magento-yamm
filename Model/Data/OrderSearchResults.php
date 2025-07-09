<?php
/**
 * OrderSearchResults
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\OrderSearchResultInterface;

class OrderSearchResults extends DataObject implements OrderSearchResultInterface
{
    const KEY_ITEMS = 'items';
    const KEY_SEARCH_CRITERIA = 'search_criteria';
    const KEY_TOTAL_COUNT = 'total_count';

    /**
     * @inheirtdoc
     */
    public function getItems()
    {
        return $this->_getData(self::KEY_ITEMS) === null ? [] : $this->_getData(self::KEY_ITEMS);
    }

    /**
     * @inheridoc
     */
    public function setItems(array $items = null)
    {
        return $this->setData(self::KEY_ITEMS, $items);
    }

    /**
     * Get search criteria
     *
     * @return \Magento\Framework\Api\SearchCriteria
     */
    public function getSearchCriteria()
    {
        return $this->_getData(self::KEY_SEARCH_CRITERIA);
    }

    /**
     * Set search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        return $this->setData(self::KEY_SEARCH_CRITERIA, $searchCriteria);
    }

    /**
     * Get total count
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->_getData(self::KEY_TOTAL_COUNT);
    }

    /**
     * @inheridoc
     */
    public function setTotalCount($totalCount)
    {
        return $this->setData(self::KEY_TOTAL_COUNT, $totalCount);
    }
}
