<?php
/**
 * RefundForm
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Block;


use Magento\AdobeStockAssetApi\Api\AssetRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Mageserv\Yamm\Helper\Data;
class RefundForm extends Template
{
    protected $_template = "Mageserv_Yamm::form/refund.phtml";

    protected $helper;
    public function __construct(
        Template\Context $context,
        Data $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    public function getHostName()
    {
        return $_SERVER['SERVER_NAME'];
    }
    public function getValidationMethod()
    {
        return $this->helper->getValidationMethod($this->_storeManager->getStore()->getId());
    }
    public function getLogoUrl()
    {
        return $this->_assetRepo->createAsset('Mageserv_Yamm::images/yamm-logo.png')->getUrl();
    }
}
