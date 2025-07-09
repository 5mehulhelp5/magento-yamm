<?php

namespace Mageserv\Yamm\Api;

interface CategoryRepositoryInterface
{
    /**
     * Retrieve list of categories
     *
     * @param int $rootCategoryId
     * @param int $depth
     * @throws \Magento\Framework\Exception\NoSuchEntityException If ID is not found
     * @return \Mageserv\Yamm\Api\Data\CategoryInterface containing Tree objects
     */
    public function getCategoriesTree($rootCategoryId = null, $depth = null);
}
