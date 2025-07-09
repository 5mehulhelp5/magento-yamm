<?php
/**
 * StoreManagement
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model;


use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Api\StoreRepositoryInterface;
use Magento\Store\Model\ScopeInterface;
use Mageserv\Yamm\Api\Data\StoreViewInterface;
use Mageserv\Yamm\Api\Data\StoreViewInterfaceFactory;
use Mageserv\Yamm\Api\StoreManagementInterface;

class StoreManagement implements StoreManagementInterface
{
    protected $storeRepository;
    protected $scopeConfig;
    protected $storeViewFactory;
    protected $dataObjectHelper;

    public function __construct(
        StoreRepositoryInterface $storeRepository,
        ScopeConfigInterface $scopeConfig,
        StoreViewInterfaceFactory $storeViewFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->storeRepository = $storeRepository;
        $this->scopeConfig = $scopeConfig;
        $this->storeViewFactory = $storeViewFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    public function getList()
    {
        $stores = $this->storeRepository->getList();
        $storeViews = [];

        foreach ($stores as $store) {
            $storeViewData = [
                'store_code' => $store->getCode(),
                'language' => $this->scopeConfig->getValue(
                    'general/locale/code',
                    ScopeInterface::SCOPE_STORE,
                    $store->getId()
                )
            ];

            /** @var StoreViewInterface $storeView */
            $storeView = $this->storeViewFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $storeView,
                $storeViewData,
                StoreViewInterface::class
            );

            $storeViews[] = $storeView;
        }

        return $storeViews;
    }
}
