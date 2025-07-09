<?php

namespace Mageserv\Yamm\Api\Data;

interface OrderItemInterface
{
    const ID = 'id';
    const NAME = 'name';
    const SKU = 'sku';
    const PRICE = 'price';
    const TOTAL_DISCOUNT = 'total_discount';
    const FINAL_PRICE = 'final_price';
    const PRODUCT_ID = 'product_id';
    const QUANTITY = 'quantity';
    const IMAGES = 'images';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string|null
     */
    public function getSku();

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * @return float|null
     */
    public function getPrice();

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * @return float|null
     */
    public function getTotalDiscount();

    /**
     * @param float $totalDiscount
     * @return $this
     */
    public function setTotalDiscount($totalDiscount);

    /**
     * @return float|null
     */
    public function getFinalPrice();

    /**
     * @param float $finalPrice
     * @return $this
     */
    public function setFinalPrice($finalPrice);

    /**
     * @return int|null
     */
    public function getProductId();

    /**
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * @return float|null
     */
    public function getQuantity();

    /**
     * @param float $quantity
     * @return $this
     */
    public function setQuantity($quantity);

    /**
     * @return string[]
     */
    public function getImages();

    /**
     * @param string[] $images
     * @return $this
     */
    public function setImages($images);
}
