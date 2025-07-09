<?php

namespace Mageserv\Yamm\Model\Data;

use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\CategoryInterface;

class Category extends DataObject implements CategoryInterface
{
    /**
     * Getter for CategoryId.
     *
     * @return int
     */
    public function getCategoryId()
    {
        return $this->_getData(self::CATEGORY_ID);
    }

    /**
     * Setter for CategoryId.
     *
     * @param int $categoryId
     *
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }

    /**
     * Getter for Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * Setter for Name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Getter for ParentId.
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->_getData(self::PARENT_ID) ?: 0;
    }

    /**
     * Setter for ParentId.
     *
     * @param int $parentId
     *
     * @return $this
     */
    public function setParentId($parentId = 0)
    {
        return $this->setData(self::PARENT_ID, $parentId);
    }

    /**
     * Getter for Status.
     *
     * @return int
     */
    public function getStatus()
    {
        return (int) $this->_getData(self::STATUS);
    }

    /**
     * Setter for Status.
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Getter for SortOrder.
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->_getData(self::SORT_ORDER);
    }

    /**
     * Setter for SortOrder.
     *
     * @param int $sortOrder
     *
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * @inheirtDoc
     */
    public function getChildren()
    {
        return $this->_getData(self::CHILDREN);
    }

    /**
     * @inheirtdoc
     */
    public function setChildren($children)
    {
        return $this->setData(self::CHILDREN, $children);
    }
}
