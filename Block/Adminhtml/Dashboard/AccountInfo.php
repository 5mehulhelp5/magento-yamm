<?php
/**
 * AccountInfo
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Block\Adminhtml\Dashboard;


use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Mageserv\Yamm\Helper\Yamm;

class AccountInfo extends Template
{
    protected $yammHelper;
    public function __construct(
        Template\Context $context,
        Yamm $yammHelper,
        array $data = [],
        ?JsonHelper $jsonHelper = null,
        ?DirectoryHelper $directoryHelper = null
    )
    {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
        $this->yammHelper = $yammHelper;
    }

    public function getAccountInfo()
    {
        return $this->yammHelper->getAccountInfo();
    }

}
