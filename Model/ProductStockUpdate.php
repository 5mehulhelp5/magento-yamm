<?php
/**
 * ProductStockUpdate
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Mageserv\Yamm\Api\ProductStockUpdateInterface;

class ProductStockUpdate implements ProductStockUpdateInterface
{
    protected $productRepository;
    protected $stockRegistry;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        StockRegistryInterface     $stockRegistry
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
    }

    public function updateStock($sku, $qty)
    {
        // Load the product
        $product = $this->productRepository->get($sku);

        // Get stock item
        $stockItem = $this->stockRegistry->getStockItemBySku($sku);
        if (!$stockItem) {
            throw new NoSuchEntityException(__('Stock item not found for SKU: %1', $sku));
        }

        // Update quantity
        $stockItem->setQty($qty);
        $stockItem->setIsInStock($qty > 0);

        // Save the stock item
        $this->stockRegistry->updateStockItemBySku($sku, $stockItem);
        return true;
    }
}
