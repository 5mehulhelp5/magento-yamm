<?php
/**
 * ExtendedOrderItem
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\ObjectManager;
use Mageserv\Yamm\Api\Data\ExtendedOrderItemInterface;
use Mageserv\Yamm\Model\ProductMapper;

class ExtendedOrderItem extends \Magento\Sales\Model\Order\Item implements ExtendedOrderItemInterface
{

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
}
