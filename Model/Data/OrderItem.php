<?php
/**
 * OrderItem
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;

use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\OrderItemInterface;

class OrderItem extends DataObject implements OrderItemInterface
{
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritdoc
     */
    public function getSku()
    {
        return $this->_getData(self::SKU);
    }

    /**
     * @inheritdoc
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->_getData(self::PRICE);
    }

    /**
     * @inheritdoc
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * @inheritdoc
     */
    public function getTotalDiscount()
    {
        return $this->_getData(self::TOTAL_DISCOUNT);
    }

    /**
     * @inheritdoc
     */
    public function setTotalDiscount($totalDiscount)
    {
        return $this->setData(self::TOTAL_DISCOUNT, $totalDiscount);
    }

    /**
     * @inheritdoc
     */
    public function getFinalPrice()
    {
        return $this->_getData(self::FINAL_PRICE);
    }

    /**
     * @inheritdoc
     */
    public function setFinalPrice($finalPrice)
    {
        return $this->setData(self::FINAL_PRICE, $finalPrice);
    }

    /**
     * @inheritdoc
     */
    public function getProductId()
    {
        return $this->_getData(self::PRODUCT_ID);
    }

    /**
     * @inheritdoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {
        return $this->_getData(self::QUANTITY);
    }

    /**
     * @inheritdoc
     */
    public function setQuantity($quantity)
    {
        return $this->setData(self::QUANTITY, $quantity);
    }

    /**
     * @inheritdoc
     */
    public function getImages()
    {
        return $this->_getData(self::IMAGES);
    }

    /**
     * @inheritdoc
     */
    public function setImages($images)
    {
        return $this->setData(self::IMAGES, $images);
    }
}
