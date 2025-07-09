<?php
/**
 * Order
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Plugin;


use Mageserv\Yamm\Model\Refund;

class Order
{
    const YAMM_STATUSES = [
        Refund::UNDER_REFUND_BY_YAMM,
        Refund::REFUNDED_BY_YAMM,
        Refund::PARTIAL_REFUND_BY_YAMM
    ];
    public function afterCanHold(
        \Magento\Sales\Model\Order $order,
        $canHold
    )
    {
        return $canHold && !in_array($order->getStatus(), self::YAMM_STATUSES);
    }
    public function afterCanCancel(
        \Magento\Sales\Model\Order $order,
                                   $canCancel
    )
    {
        return $canCancel && !in_array($order->getStatus(), self::YAMM_STATUSES);
    }
}
