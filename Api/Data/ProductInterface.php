<?php

namespace Mageserv\Yamm\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

interface ProductInterface extends CustomAttributesDataInterface
{
    const PRODUCT_ID = 'product_id';
    const NAME = 'name';
    const SKU = 'sku';
    const STATUS = 'status';
    const IS_SALABLE = 'is_salable';
    const PRICE = 'price';
    const TYPE = 'type';
    const SPECIAL_PRICE = 'special_price';
    const SAVE_PERCENT = 'save_percent';
    const IMAGE = 'image';
    const REVIEWS_COUNT = 'reviews_count';
    const RATING = 'rating';
    const REMAINING_QTY = 'remaining_qty';
    const URL_KEY = 'url_key';
    const CATEGORY_IDS = "category_ids";
    const GALLERY = "gallery";
    const PRODUCT_URL = "product_url";
    const META_TITLE = "meta_title";
    const META_DESCRIPTION = "meta_description";
    const META_KEYWORDS = "meta_keywords";
    const DESCRIPTION = "description";
    const VARIANTS_PRODUCTS = "variants_products";
    const CATEGORIES_TREE   =   "categories_tree";

    /**
     * Get product ID.
     *
     * @return int
     */
    public function getProductId();

    /**
     * Set product ID.
     *
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * Get product name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set product name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get SKU.
     *
     * @return string
     */
    public function getSku();

    /**
     * Set SKU.
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get salable status.
     *
     * @return bool|null
     */
    public function getIsSalable();

    /**
     * Set salable status.
     *
     * @param bool $isSalable
     * @return $this
     */
    public function setIsSalable($isSalable);

    /**
     * Get price.
     *
     * @return float|null
     */
    public function getPrice();

    /**
     * Set price.
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Get type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set type.
     *
     * @param string $type
     * @return $this
     */
    public function setType($type);

    /**
     * Get special price.
     *
     * @return float|null
     */
    public function getSpecialPrice();

    /**
     * Set special price.
     *
     * @param float $specialPrice
     * @return $this
     */
    public function setSpecialPrice($specialPrice);

    /**
     * Get save percent.
     *
     * @return float|null
     */
    public function getSavePercent();

    /**
     * Set save percent.
     *
     * @param float $savePercent
     * @return $this
     */
    public function setSavePercent($savePercent);

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage();

    /**
     * Set image.
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image);

    /**
     * Get reviews count.
     *
     * @return int
     */
    public function getReviewsCount();

    /**
     * Set reviews count.
     *
     * @param int $reviewsCount
     * @return $this
     */
    public function setReviewsCount($reviewsCount);

    /**
     * Get rating.
     *
     * @return float|null
     */
    public function getRating();

    /**
     * Set rating.
     *
     * @param float $rating
     * @return $this
     */
    public function setRating($rating);

    /**
     * Get remaining quantity.
     *
     * @return int
     */
    public function getRemainingQty();

    /**
     * Set remaining quantity.
     *
     * @param int $remainingQty
     * @return $this
     */
    public function setRemainingQty($remainingQty);

    /**
     * Get URL key.
     *
     * @return string
     */
    public function getUrlKey();

    /**
     * Set URL key.
     *
     * @param string $urlKey
     * @return $this
     */
    public function setUrlKey($urlKey);

    /**
     * Get category IDs.
     *
     * @return string[]
     */
    public function getCategoryIds();

    /**
     * Set category IDs.
     *
     * @param string[] $ids
     * @return $this
     */
    public function setCategoryIds($ids);
    /**
     * Get gallery data
     *
     * @return string[]
     */
    public function getGallery();

    /**
     * Set gallery data
     *
     * @param string[] $gallery
     * @return $this
     */
    public function setGallery($gallery);


    /**
     * Get product URL
     *
     * @return string
     */
    public function getProductUrl();

    /**
     * Set product URL
     *
     * @param string $productUrl
     * @return $this
     */
    public function setProductUrl($productUrl);

    /**
     * Get meta title
     *
     * @return string
     */
    public function getMetaTitle();

    /**
     * Set meta title
     *
     * @param string $metaTitle
     * @return $this
     */
    public function setMetaTitle($metaTitle);

    /**
     * Get meta description
     *
     * @return string
     */
    public function getMetaDescription();

    /**
     * Set meta description
     *
     * @param string $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription);

    /**
     * Get meta keywords
     *
     * @return string
     */
    public function getMetaKeywords();

    /**
     * Set meta keywords
     *
     * @param string $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Get variants products
     *
     * @return \Mageserv\Yamm\Api\Data\ProductInterface[]
     */
    public function getVariantsProducts();

    /**
     * Set variants products
     *
     * @param \Mageserv\Yamm\Api\Data\ProductInterface[] $variantsProducts
     * @return $this
     */
    public function setVariantsProducts($variantsProducts);

    /**
     * Get categories tree
     *
     * @return \Mageserv\Yamm\Api\Data\CategoryInterface[]
     */
    public function getCategoriesTree();

    /**
     * Set categories tree
     *
     * @param \Mageserv\Yamm\Api\Data\CategoryInterface[] $categoriesTree
     * @return $this
     */
    public function setCategoriesTree($categoriesTree);
}
