<?php
/**
 * FirstCompleteAt
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use Magento\Framework\App\ResourceConnection;
use Psr\Log\LoggerInterface;
class FirstCompleteAt implements ObserverInterface
{
    protected $resource;
    protected $logger;

    public function __construct(ResourceConnection $resource, LoggerInterface $logger)
    {
        $this->resource = $resource;
        $this->logger = $logger;
    }
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getEvent()->getOrder();

            if ($order->getState() === Order::STATE_COMPLETE && !$order->getData('first_complete_at')) {
                $connection = $this->resource->getConnection();
                $tableName = $this->resource->getTableName('sales_order');

                $completedAt = (new \DateTime())->format('Y-m-d H:i:s');

                // Update order attribute directly in the database
                $connection->update(
                    $tableName,
                    ['first_complete_at' => $completedAt],
                    ['entity_id = ?' => $order->getId()]
                );
            }
        } catch (\Exception $e) {
        }
    }
}
