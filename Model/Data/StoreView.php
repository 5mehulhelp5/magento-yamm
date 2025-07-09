<?php
/**
 * StoreView
 *
 * @copyright Copyright © 2025 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\StoreViewInterface;

class StoreView extends DataObject implements StoreViewInterface
{

    /**
     * @inheritDoc
     */
    public function getStoreCode()
    {
        return $this->getData(self::STORE_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setStoreCode($storeCode)
    {
        return $this->setData(self::STORE_CODE, $storeCode);
    }

    /**
     * @inheritDoc
     */
    public function getLanguage()
    {
        return $this->getData(self::LANGUAGE);
    }

    /**
     * @inheritDoc
     */
    public function setLanguage($language)
    {
        return $this->setData(self::LANGUAGE, $language);
    }
}
