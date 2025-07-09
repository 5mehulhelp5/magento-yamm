<?php
/**
 * ProductMapper
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model;


use Magento\Authorization\Model\UserContextInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\GroupedProduct\Model\Product\Type\Grouped;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Catalog\Model\CategoryFactory;
use Mageserv\Yamm\Api\Data\ProductInterface;
use Mageserv\Yamm\Api\Data\ProductInterfaceFactory;
use Magento\CatalogInventory\Api\StockRegistryInterface;

class ProductMapper
{
    public function __construct(
        protected ProductInterfaceFactory                                $productInterfaceFactory,
        protected StoreManagerInterface                                  $storeManager,
        protected ProductCollectionFactory                               $productCollectionFactory,
        protected \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus,
        protected \Magento\Catalog\Model\Product\Visibility              $productVisibility,
        protected GroupCollectionFactory                                 $groupCollectionFactory,
        protected \Magento\Review\Model\Rating                           $rating,
        protected ReviewCollectionFactory                                $reviewCollectionFactory,
        protected CategoryFactory                                        $categoryFactory,
        protected ManagerInterface                                       $eventManager,
        protected ProductRepositoryInterface                             $productRepository,
        protected Configurable                                           $configurable,
        protected Grouped                                                $grouped,
        protected StockRegistryInterface $stockRegistry
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function mapFromProduct($product)
    {
        if (!$product instanceof \Magento\Catalog\Api\Data\ProductInterface) {
            $product = $this->productRepository->getById($product);
        }

        $summaryProduct = $this->setMandatoryData($product);

        $galleryImages = [];
        foreach ($product->getMediaGalleryEntries() as $mediaGalleryEntry) {
            if (!filter_var($mediaGalleryEntry->getFile(), FILTER_VALIDATE_URL)) {
                $galleryImages[] = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    . "catalog/product/" . $mediaGalleryEntry->getFile();
            } else {
                $galleryImages[] = $mediaGalleryEntry->getFile();
            }
        }

        //get Categories
        $categories = [];
        if ($product->getCategoryIds()) {
            $catIds = $product->getCategoryIds();
            $lastCategoryId = count($catIds) > 3 ? $catIds[2] : end($catIds);
            $category = $this->categoryFactory->create()->load($lastCategoryId);
            $path = explode("/", $category->getPath());
            if (count($path)) {
                $collection = $this->categoryFactory->create()->getCollection()
                    ->addAttributeToSelect("name")
                    ->addAttributeToSelect("is_active")
                    ->addAttributeToSelect("url_key")
                    ->addAttributeToFilter("level", ["gteq" => 2])
                    ->addAttributeToFilter("entity_id", ["in" => $path])
                    ->addFieldToFilter("is_active", 1)
                    ->setOrder("level", "ASC");
                $categories = $collection->getItems();
            }
        }
        $summaryProduct->setGallery($galleryImages)
            ->setProductUrl($product->getProductUrl())
            ->setCategoriesTree($categories);
        if ($product->getTypeId() == "configurable") {
            $configurableAttributes = $this->configurable->getConfigurableAttributesAsArray($product);
            $childrenIds = $this->configurable->getChildrenIds($product->getId());
            $products = array_map(function ($id)  {
                return $this->mapFromProduct($id);
            }, array_values($childrenIds)[0]);
            $summaryProduct->setVariantsProducts($products);
        }
        return $summaryProduct;
    }
    private function getSkuQty($productId)
    {
        return $this->stockRegistry->getStockStatus($productId)->getQty();

    }
    /**
     * @param $product
     * @return \Mageserv\Yamm\Api\Data\ProductInterface
     */
    private function setMandatoryData($product)
    {
        $summaryProduct = $this->productInterfaceFactory->create();
        $summaryProduct->setProductId($product->getId())
            ->setName($product->getName())
            ->setSku($product->getSku())
            ->setStatus($product->getStatus())
            ->setIsSalable($product->isSalable())
            ->setPrice($product->getPrice())
            ->setType($product->getTypeId())
            ->setSpecialPrice($product->getSpecialPrice())
            ->setSavePercent($this->calculateSavePercent($product))
            ->setImage($this->getProductImage($product))
            ->setCategoryIds($product->getCategoryIds())
            ->setUrlKey($product->getUrlKey())
            ->setRemainingQty($this->getSkuQty($product->getId()))
            ->setCustomAttributes($product->getCustomAttributes());

        if ($product->getTypeId() == "configurable") {
            $children = $product->getTypeInstance()->getUsedProducts($product);
            if (!empty($children)) {
                $priceArray = [];
                foreach ($children as $child) {
                    $priceArray[] = $child->getPrice();
                }
                if (!empty($priceArray)) {
                    $price = max($priceArray);
                    $summaryProduct->setPrice($price);
                }
            }
        }

        $_ratingSummary = $this->rating->getEntitySummary($product->getId());
        $product_rating = 0;
        if ($_ratingSummary->getCount()) {
            $product_rating_percenet =
                $_ratingSummary->getSum() / $_ratingSummary->getCount() / 100;
            $product_rating = ceil(5 * $product_rating_percenet);
            if (!$product_rating_percenet) {
                $product_rating = 0;
            }
        }
        $summaryProduct->setRating($product_rating)
            ->setReviewsCount($_ratingSummary->getCount());

        return $summaryProduct;
    }

    protected function calculateSavePercent($product)
    {
        if ($product->getSpecialPrice() && $product->getPrice()) {
            return round(100 - (($product->getSpecialPrice() / $product->getPrice()) * 100));
        }
        return 0;
    }

    public function getProductImage($product)
    {
        if ($product->getImage() && !filter_var($product->getImage(), FILTER_VALIDATE_URL)) {
            return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                . "catalog/product" . $product->getImage();
        }
        return $product->getImage();
    }

}
