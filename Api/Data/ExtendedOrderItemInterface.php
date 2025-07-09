<?php

namespace Mageserv\Yamm\Api\Data;

interface ExtendedOrderItemInterface extends \Magento\Sales\Api\Data\OrderItemInterface
{
    const IMAGE = 'image';

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image);
}
