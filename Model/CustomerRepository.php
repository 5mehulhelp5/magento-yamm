<?php
/**
 * CustomerRepository
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model;


use Magento\Customer\Api\Data\AddressInterface;
use Mageserv\Yamm\Api\CustomerRepositoryInterface;
use Mageserv\Yamm\Api\Data\CustomerInterface;
use Mageserv\Yamm\Api\Data\CustomerInterfaceFactory;
use Mageserv\Yamm\Api\Data\CustomerSearchResultsInterface;
use Mageserv\Yamm\Api\Data\CustomerSearchResultsInterfaceFactory;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $customerRepository;
    protected $customerInterfaceFactory;
    protected $customerSearchResultsInterfaceFactory;
    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerInterfaceFactory,
        CustomerSearchResultsInterfaceFactory $customerSearchResultsInterfaceFactory
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerInterfaceFactory = $customerInterfaceFactory;
        $this->customerSearchResultsInterfaceFactory = $customerSearchResultsInterfaceFactory;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $list = $this->customerRepository->getList($searchCriteria);
        $items = $list->getItems();
        $customers = [];
        foreach ($items as $item) {
            /** @var CustomerInterface $customer */
            $customer = $this->customerInterfaceFactory->create();
            $customer->setStoreCustomerId($item->getId())
                ->setEmail($item->getEmail())
                ->setFirstName($item->getFirstname())
                ->setLastName($item->getLastname())
                ->setGender($item->getGender())
                ->setStoreUpdatedAt($item->getUpdatedAt());
            /** @var ?AddressInterface $defaultAddress */
            if($item->getAddresses()){
                $defaultAddress = null;
               foreach ($item->getAddresses() as $address) {
                    if ($address->isDefaultBilling()) {
                        $defaultAddress = $address;
                        break;
                    }
                }
                /** @var ?AddressInterface $defaultAddress */
                if($defaultAddress){
                    $customer->setCity($defaultAddress->getCity())
                        ->setCountryCode($defaultAddress->getCountryId())
                        ->setMobile($defaultAddress->getTelephone())
                        ->setLocation(implode("\n", $defaultAddress->getStreet()));
                }
            }

            $customers[] = $customer;
        }
        /** @var CustomerSearchResultsInterface $results */
        $results = $this->customerSearchResultsInterfaceFactory->create();
        $results->setItems($customers)
            ->setSearchCriteria($list->getSearchCriteria())
            ->setTotalCount($list->getTotalCount());
        return $results;
    }

    public function getById($id)
    {
        $item = $this->customerRepository->getById($id);
        $customer = $this->customerInterfaceFactory->create();
        $customer->setStoreCustomerId($item->getId())
            ->setEmail($item->getEmail())
            ->setFirstName($item->getFirstname())
            ->setLastName($item->getLastname())
            ->setGender($item->getGender())
            ->setStoreUpdatedAt($item->getUpdatedAt());
        /** @var ?AddressInterface $defaultAddress */
        if($item->getAddresses()) {
            $defaultAddress = array_filter($item->getAddresses(), function ($address) {
                return $address->isDefaultBilling();
            });
            $defaultAddress = count($defaultAddress) ? $defaultAddress[0] : null;
            /** @var ?AddressInterface $defaultAddress */
            if ($defaultAddress) {
                $customer->setCity($defaultAddress->getCity())
                    ->setCountryCode($defaultAddress->getCountryId())
                    ->setMobile($defaultAddress->getTelephone())
                    ->setLocation(implode("\n", $defaultAddress->getStreet()));
            }
        }
        return $customer;
    }
}
