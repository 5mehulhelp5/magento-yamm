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

class AddRefundOrderStatus implements DataPatchInterface
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
            ['status' => Refund::UNDER_REFUND_BY_YAMM, 'label' => 'Under Refund By Yamm'],
            ['status' => Refund::REFUNDED_BY_YAMM, 'label' => 'Refunded By Yamm'],
            ['status' => Refund::PARTIAL_REFUND_BY_YAMM, 'label' => 'Partially Refunded By Yamm'],
        ]);

        //Bind status to state
        $states = [
            [
                'status'     => Refund::UNDER_REFUND_BY_YAMM,
                'state'      => Refund::UNDER_REFUND_BY_YAMM,
                'is_default' => 0,
            ],
            [
                'status'     => Refund::REFUNDED_BY_YAMM,
                'state'      => Refund::REFUNDED_BY_YAMM,
                'is_default' => 0,
            ],
            [
                'status'     => Refund::PARTIAL_REFUND_BY_YAMM,
                'state'      => Refund::PARTIAL_REFUND_BY_YAMM,
                'is_default' => 0,
            ]
        ];
        foreach ($states as $state) {
            $this->moduleDataSetup->getConnection()->insertOnDuplicate(
                $this->moduleDataSetup->getTable('sales_order_status_state'),
                $state
            );
        }
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
