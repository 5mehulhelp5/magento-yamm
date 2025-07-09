<?php
/**
 * Data
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const UNKNOWN = "Unknown";
    const IS_MODULE_ENABLED = "yamm_refunds/general_configuration/enable";
    const VALIDATION_METHOD_XML_PATH = "yamm_refunds/general_configuration/validation_method";
    const MOBILE_ATTRIBUTE_XML_PATH = "yamm_refunds/general_configuration/mobile_attribute";
    const MOBILE_ATTRIBUTE_CODE_XML_PATH = "yamm_refunds/general_configuration/mobile_attribute_code";
    const ALLOWED_PAYMENT_METHODS_CODE_XML_PATH = "yamm_refunds/general_configuration/allowed_payment_methods";
    const SHOW_REFUND_FORM_XML_PATH = "yamm_refunds/general_configuration/show_refund_form";
    const REFUND_FORM_PAGE_XML_PATH = "yamm_refunds/general_configuration/refund_policy_page";
    protected $directoryList;
    protected $componentRegistrar;
    public function __construct(
        Context $context,
        DirectoryList $directoryList,
        ComponentRegistrarInterface $componentRegistrar
    )
    {
        parent::__construct($context);
        $this->directoryList = $directoryList;
        $this->componentRegistrar = $componentRegistrar;
    }

    public function isModuleEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::IS_MODULE_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get plugin version in composer.json
     * @param null $moduleName
     * @return string
     */
    public function getPluginVersion($moduleName = null) {
        $composerJsonPath = $this->getModuleDir($moduleName) . DIRECTORY_SEPARATOR . "composer.json";
        if (file_exists($composerJsonPath)) {
            $content = file_get_contents($composerJsonPath);
            if ($content) {
                $jsonContent = json_decode($content, true);
                if (!empty($jsonContent['version'])) {
                    return $jsonContent['version'];
                }
            }
        }
        return self::UNKNOWN;
    }

    /**
     * @return Json|mixed
     */
    public static function getJsonHelper()
    {
        return ObjectManager::getInstance()->get(\Magento\Framework\Serialize\Serializer\Json::class);
    }
    public static function jsonEncode($valueToEncode)
    {
        try {
            $encodeValue = self::getJsonHelper()->serialize($valueToEncode);
        } catch (\Exception $e) {
            $encodeValue = '{}';
        }
        return $encodeValue;
    }

    /**
     * @param null $moduleName
     * @return string|null
     */
    public function getModuleDir($moduleName = null) {
        if (!$moduleName) {
            $moduleName = $this->_getModuleName();
        }
        $path = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, $moduleName);
        if (empty($type) && !isset($path)) {
            throw new \InvalidArgumentException("Module '$moduleName' is not correctly registered.");
        }
        return $path;
    }
    public function getValidationMethod($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::VALIDATION_METHOD_XML_PATH,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
    public function getMobileAttribute($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::MOBILE_ATTRIBUTE_XML_PATH,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
    public function getMobileAttributeCode($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::MOBILE_ATTRIBUTE_CODE_XML_PATH,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
    public function isAllowedMethod($method)
    {
        $allowedMethods = $this->scopeConfig->getValue(
            self::ALLOWED_PAYMENT_METHODS_CODE_XML_PATH
        );
        if(strlen($allowedMethods)){
            $allowedMethods = explode(',', $allowedMethods);
        }
        return (bool) ( is_array($allowedMethods) && in_array($method, $allowedMethods) );
    }
    public function isRefundFormVisible($storeId = null)
    {
        return $this->scopeConfig->isSetFlag(
            self::SHOW_REFUND_FORM_XML_PATH,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
    public function getRefundPageIdentifier($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::REFUND_FORM_PAGE_XML_PATH,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );
    }
}
