<?php
namespace Mageserv\Yamm\Api;

interface ProductStockUpdateInterface
{
    /**
     * Update product stock quantity
     *
     * @param string $sku
     * @param float $qty
     * @return bool
     */
    public function updateStock($sku, $qty);
}
