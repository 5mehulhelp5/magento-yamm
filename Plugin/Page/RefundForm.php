<?php
/**
 * RefundForm
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Plugin\Page;

use Magento\Store\Model\StoreManagerInterface;
use Mageserv\Yamm\Helper\Data;
class RefundForm
{
    protected $helper;
    protected $storeManager;
    protected $layout;
    public function __construct(
        Data $helper,
        StoreManagerInterface $storeManager,
        \Magento\Framework\View\LayoutInterface $layout,
    )
    {
        $this->helper = $helper;
        $this->storeManager = $storeManager;
        $this->layout = $layout;
    }

    public function afterGetContent(
        \Magento\Cms\Model\Page $subject,
        $content
    )
    {
        if($this->helper->isModuleEnabled() && $this->helper->isRefundFormVisible($this->storeManager->getStore()->getId())){
            if($subject->getIdentifier() == $this->helper->getRefundPageIdentifier($this->storeManager->getStore()->getId())){
                $block = $this->layout->createBlock(
                    \Mageserv\Yamm\Block\RefundForm::class
                )->toHtml();
                $content .= $block;
            }
        }
        return $content;
    }
}
