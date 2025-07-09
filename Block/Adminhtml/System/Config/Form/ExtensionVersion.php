<?php
/**
 * ExtensionVersion
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Block\Adminhtml\System\Config\Form;


use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Mageserv\Yamm\Helper\Data;
class ExtensionVersion extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    protected function _renderValue(AbstractElement $element)
    {
        $version = $this->getVersion();
        if ($version == Data::UNKNOWN) {
            $version = "Cannot get plugin version from composer";
        }
        return '<td class="value">Plugin version: ' . $version . '</td>';
    }

    public function getVersion()
    {
        return $this->helper->getPluginVersion();
    }

    protected function _renderInheritCheckbox(AbstractElement $element)
    {
        return '<td class="use-default"></td>';
    }
}
