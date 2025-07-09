<?php
/**
 * Product
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model\Data;

use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\ProductInterface;

class Product extends DataObject implements ProductInterface
{
    public function getProductId()
    {
        return $this->_getData(self::PRODUCT_ID);
    }

    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getSku()
    {
        return $this->_getData(self::SKU);
    }

    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function getIsSalable()
    {
        return $this->_getData(self::IS_SALABLE);
    }

    public function setIsSalable($isSalable)
    {
        return $this->setData(self::IS_SALABLE, $isSalable);
    }

    public function getPrice()
    {
        return $this->_getData(self::PRICE);
    }

    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    public function getType()
    {
        return $this->_getData(self::TYPE);
    }

    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    public function getGallery()
    {
        return $this->_getData(self::GALLERY);
    }

    public function setGallery($gallery)
    {
        return $this->setData(self::GALLERY, $gallery);
    }

    public function getProductUrl()
    {
        return $this->_getData(self::PRODUCT_URL);
    }

    public function setProductUrl($productUrl)
    {
        return $this->setData(self::PRODUCT_URL, $productUrl);
    }

    public function getMetaTitle()
    {
        return $this->_getData(self::META_TITLE);
    }

    public function setMetaTitle($metaTitle)
    {
        return $this->setData(self::META_TITLE, $metaTitle);
    }

    public function getMetaDescription()
    {
        return $this->_getData(self::META_DESCRIPTION);
    }

    public function setMetaDescription($metaDescription)
    {
        return $this->setData(self::META_DESCRIPTION, $metaDescription);
    }

    public function getMetaKeywords()
    {
        return $this->_getData(self::META_KEYWORDS);
    }

    public function setMetaKeywords($metaKeywords)
    {
        return $this->setData(self::META_KEYWORDS, $metaKeywords);
    }

    public function getDescription()
    {
        return $this->_getData(self::DESCRIPTION);
    }

    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function getVariantsProducts()
    {
        return $this->_getData(self::VARIANTS_PRODUCTS);
    }

    public function setVariantsProducts($variantsProducts)
    {
        return $this->setData(self::VARIANTS_PRODUCTS, $variantsProducts);
    }

    public function getCategoriesTree()
    {
        return $this->_getData(self::CATEGORIES_TREE);
    }

    public function setCategoriesTree($categoriesTree)
    {
        return $this->setData(self::CATEGORIES_TREE, $categoriesTree);
    }
    public function getCustomAttributes()
    {
        return $this->_getData(self::CUSTOM_ATTRIBUTES);
    }

    public function setCustomAttributes(array $attributes)
    {
        return $this->setData(self::CUSTOM_ATTRIBUTES, $attributes);
    }

    public function getCustomAttribute($attributeCode)
    {
        return null;
    }

    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSpecialPrice()
    {
        return $this->_getData(self::SPECIAL_PRICE);
    }

    /**
     * @inheritDoc
     */
    public function setSpecialPrice($specialPrice)
    {
        return $this->setData(self::SPECIAL_PRICE, $specialPrice);
    }

    /**
     * @inheritDoc
     */
    public function getSavePercent()
    {
        return $this->_getData(self::SAVE_PERCENT);
    }

    /**
     * @inheritDoc
     */
    public function setSavePercent($savePercent)
    {
        return $this->setData(self::SAVE_PERCENT, $savePercent);
    }

    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->_getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getReviewsCount()
    {
        return $this->_getData(self::REVIEWS_COUNT);
    }

    /**
     * @inheritDoc
     */
    public function setReviewsCount($reviewsCount)
    {
        return $this->setData(self::REVIEWS_COUNT, $reviewsCount);
    }

    /**
     * @inheritDoc
     */
    public function getRating()
    {
        return $this->_getData(self::RATING);
    }

    /**
     * @inheritDoc
     */
    public function setRating($rating)
    {
        return $this->setData(self::RATING, $rating);
    }

    /**
     * @inheritDoc
     */
    public function getRemainingQty()
    {
        return $this->_getData(self::REMAINING_QTY);
    }

    /**
     * @inheritDoc
     */
    public function setRemainingQty($remainingQty)
    {
       return $this->setData(self::REMAINING_QTY, $remainingQty);
    }

    /**
     * @inheritDoc
     */
    public function getUrlKey()
    {
        return $this->_getData(self::URL_KEY);
    }

    /**
     * @inheritDoc
     */
    public function setUrlKey($urlKey)
    {
        return $this->setData(self::URL_KEY, $urlKey);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryIds()
    {
        return $this->_getData(self::CATEGORY_IDS);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryIds($ids)
    {
        return $this->setData(self::CATEGORY_IDS, $ids);
    }
}
