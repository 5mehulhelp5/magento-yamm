<?php
namespace Mageserv\Yamm\Api\Data;

interface StoreViewInterface
{
    const STORE_CODE = 'store_code';
    const LANGUAGE = 'language';
    /**
     * Get store view code
     *
     * @return string
     */
    public function getStoreCode();

    /**
     * Set store view code
     *
     * @param string $storeCode
     * @return $this
     */
    public function setStoreCode($storeCode);

    /**
     * Get store view language
     *
     * @return string
     */
    public function getLanguage();

    /**
     * Set store view language
     *
     * @param string $language
     * @return $this
     */
    public function setLanguage($language);
}
