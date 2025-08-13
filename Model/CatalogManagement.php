<?php
/**
 * CatalogManagement
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Mageserv\Yamm\Api\CatalogManagementInterface;
use Mageserv\Yamm\Api\Data\ProductSearchResultsInterfaceFactory;

class CatalogManagement implements CatalogManagementInterface
{
    protected $productRepository;
    protected $productMapper;
    protected $productSearchResultsFactory;
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductMapper $productMapper,
        ProductSearchResultsInterfaceFactory $productSearchResultsFactory
    )
    {
        $this->productRepository = $productRepository;
        $this->productMapper = $productMapper;
        $this->productSearchResultsFactory = $productSearchResultsFactory;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $products = $this->productRepository->getList($searchCriteria);
        $items = array_map(function ($product) {
            return $this->productMapper->mapFromProduct($product);
        }, $products->getItems());
        /** @var \Mageserv\Yamm\Api\Data\ProductSearchResultsInterface $results */
        $results = $this->productSearchResultsFactory->create();
        $results->setSearchCriteria($searchCriteria)
            ->setItems($items)
            ->setTotalCount($products->getTotalCount());
        return $results;
    }

    /**
     * @inheritDoc
     */
    public function get($sku)
    {
        $product = $this->productRepository->get($sku);
        return $this->productMapper->mapFromProduct($product);
    }
    /**
     * @inheritDoc
     */
    public function getById(int $id)
    {
        $product = $this->productRepository->getById($id);
        return $this->productMapper->mapFromProduct($product);
    }
}
