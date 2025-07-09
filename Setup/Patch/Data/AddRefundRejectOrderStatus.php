<?php
/**
 * AddRefundOrderStatus
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Mageserv\Yamm\Model\Refund;

class AddRefundRejectOrderStatus implements DataPatchInterface
{

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->insertOnDuplicate(
            $this->moduleDataSetup->getTable('sales_order_status'),[
            ['status' => Refund::REFUND_REJECTED_BY_YAMM, 'label' => 'Refund Rejected By Yamm'],
        ]);
        $this->moduleDataSetup->getConnection()->insertOnDuplicate(
            $this->moduleDataSetup->getTable('sales_order_status_state'),
            [
                'status'     => Refund::REFUND_REJECTED_BY_YAMM,
                'state'      => Refund::REFUND_REJECTED_BY_YAMM,
                'is_default' => 0,
            ],
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
