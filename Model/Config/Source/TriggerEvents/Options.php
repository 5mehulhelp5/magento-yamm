<?php
/**
 * Options
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Config\Source\TriggerEvents;


use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    // Orders
    const CREATE_ORDER = "sales_order.create";
    const DELETE_ORDER = "sales_order.delete";
    const CANCEL_ORDER = "sales_order.cancel";
    const UPDATED_ORDER = "sales_order.update";
    const FETCH_ORDER = "sales_order.fetch";

    // Catalog
    const CREATE_PRODUCT = "catalog_product.create";
    const UPDATE_PRODUCT = "catalog_product.update";
    const DELETE_PRODUCT = "catalog_product.delete";

    // categories
    const CREATE_CATEGORY = "catalog_category.create";
    const UPDATE_CATEGORY = "catalog_category.update";
    const DELETE_CATEGORY = "catalog_category.delete";

    //customers
    const CREATE_CUSTOMER = "customer.create";
    const UPDATE_CUSTOMER = "customer.update";
    const DELETE_CUSTOMER = "customer.delete";

    public function toOptionArray()
    {
        return [
            ['value' => self::CREATE_ORDER, 'label' => __('Create order')],
            ['value' => self::CANCEL_ORDER, 'label' => __('Cancel order')],
            ['value' => self::UPDATED_ORDER, 'label' => __('Update Order')],
            ['value' => self::DELETE_ORDER, 'label' => __('Delete Order')],

            ['value' => self::CREATE_PRODUCT, 'label' => __('Create Product')],
            ['value' => self::UPDATE_PRODUCT, 'label' => __('Update Product')],
            ['value' => self::DELETE_PRODUCT, 'label' => __('Delete Product')],

            ['value' => self::CREATE_CATEGORY, 'label' => __('Create Category')],
            ['value' => self::UPDATE_CATEGORY, 'label' => __('Update Category')],
            ['value' => self::DELETE_CATEGORY, 'label' => __('Delete Category')],

            ['value' => self::CREATE_CUSTOMER, 'label' => __('Create Customer')],
            ['value' => self::UPDATE_CUSTOMER, 'label' => __('Update Customer')],
            ['value' => self::DELETE_CUSTOMER, 'label' => __('Delete Customer')],
        ];
    }
}
