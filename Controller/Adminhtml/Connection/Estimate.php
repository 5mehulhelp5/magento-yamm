<?php
/**
 * Estimate
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Connection;


use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Customer\Model\ResourceModel\Customer\Collection;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Collection as OrderCollection;
use Magento\Framework\Phrase;
use Mageserv\Yamm\Helper\Yamm as YammHelper;
use Mageserv\Yamm\Helper\Data;
use Mageserv\Yamm\Model\Config\Source\CronType;

class Estimate extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mageserv_Yamm::configuration';

    /**
     * @var YammHelper
     */
    protected $yammHelper;

    /**
     * @var CustomerCollectionFactory
     */
    protected $customerCollectionFactory;

    /**
     * @var OrderCollectionFactory
     */
    protected $orderCollectionFactory;
    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;
    /**
     * @var CategoryCollectionFactory
     */
    protected $categoryCollectionFactory;


    public function __construct(
        Context $context,
        YammHelper $yammHelper,
        CustomerCollectionFactory $customerCollectionFactory,
        OrderCollectionFactory $orderCollectionFactory,
        ProductCollectionFactory $productCollectionFactory,
        CategoryCollectionFactory $categoryCollectionFactory
    ) {
        $this->yammHelper              = $yammHelper;
        $this->customerCollectionFactory   = $customerCollectionFactory;
        $this->orderCollectionFactory      = $orderCollectionFactory;
        $this->productCollectionFactory      = $productCollectionFactory;
        $this->categoryCollectionFactory      = $categoryCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        try {

            if (!$this->yammHelper->isConnected()) {
                throw new LocalizedException(__('Connection to Yamm not found, Please add your api key and click test connection'));
            }
            $types = [
                CronType::CUSTOMER,
                CronType::ORDER,
                CronType::PRODUCT,
                CronType::CATEGORY
            ];
            $result = [];
            foreach ($types as $type){
                $collection  = $this->prepareCollection($type);
                $ids = $collection->getAllIds();
                $result['data'][$type] = [
                    'ids' => $ids,
                    'total' => count($ids)
                ];
                if(count($ids) === 0){
                    $result['data'][$type]['message'] = $this->getZeroMessage($type);
                }
            }
            $result['status'] = true;
        } catch (Exception $e) {
            $result = [
                'status'  => false,
                'message' => $e->getMessage()
            ];
        }

        return $this->getResponse()->representJson(Data::jsonEncode($result));
    }

    public function prepareCollection($type)
    {
        switch ($type) {
            case CronType::CUSTOMER:
                return $this->customerCollectionFactory->create();
            case CronType::ORDER:
                return $this->orderCollectionFactory->create();
            case CronType::PRODUCT:
                return $this->productCollectionFactory->create();
            case CronType::CATEGORY:
                return $this->categoryCollectionFactory->create();
            default:
                return false;
        }
    }

    /**
     * @param int $type
     *
     * @return Phrase|string
     */
    public function getZeroMessage($type)
    {
        switch ($type) {
            case CronType::CUSTOMER:
                return __('No customers to synchronize.');
            case CronType::ORDER:
                return __('No Orders to synchronize.');
            case CronType::PRODUCT:
                return __('No Products to synchronize.');
            case CronType::CATEGORY:
                return __('No Categories to synchronize.');
            default:
                return '';
        }
    }
}
