<?php

namespace Mageserv\Yamm\Api\Data;

interface CategoryInterface
{
    /**
     * String constants for property names
     */
    public const CATEGORY_ID = "category_id";
    public const NAME = "name";
    public const PARENT_ID = "parent_id";
    public const STATUS = "status";
    public const SORT_ORDER = "sort_order";
    public const CHILDREN = "children";

    /**
     * Getter for CategoryId.
     *
     * @return int
     */
    public function getCategoryId();

    /**
     * Setter for CategoryId.
     *
     * @param int $categoryId
     *
     * @return $this
     */
    public function setCategoryId($categoryId);

    /**
     * Getter for Name.
     *
     * @return string
     */
    public function getName();

    /**
     * Setter for Name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Getter for ParentId.
     *
     * @return int
     */
    public function getParentId();

    /**
     * Setter for ParentId.
     *
     * @param int $parentId
     *
     * @return $this
     */
    public function setParentId($parentId);

    /**
     * Getter for Status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Setter for Status.
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Getter for SortOrder.
     *
     * @return int
     */
    public function getSortOrder();

    /**
     * Setter for SortOrder.
     *
     * @param int $sortOrder
     *
     * @return $this
     */
    public function setSortOrder(?int $sortOrder);

    /**
     * Getter for Children.
     *
     * @return \Mageserv\Yamm\Api\Data\CategoryInterface[]
     */
    public function getChildren();

    /**
     * Setter for Children.
     *
     * @param \Mageserv\Yamm\Api\Data\CategoryInterface[] $children
     *
     * @return $this
     */
    public function setChildren($children);
}
