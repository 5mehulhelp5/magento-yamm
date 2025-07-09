<?php
/**
 * Authorization
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Plugin\Acl;


use Magento\Framework\Webapi\Request;
use Mageserv\Yamm\Helper\Yamm;

class Authorization
{
    protected $yammHelper;
    protected $request;
    public function __construct(
        Yamm $yammHelper,
        Request $request
    )
    {
        $this->yammHelper = $yammHelper;
        $this->request = $request;
    }

    public function aroundIsAllowed(
        \Magento\Framework\Authorization $subject,
        \Closure $proceed,
        $resource,
        $privilege = null
    )
    {
        $result = $proceed($resource);

        if ($resource == 'Mageserv_Yamm::api') {
            $authorization = $this->request->getHeader('Authorization');
            $authorizationKey = str_replace("Bearer ", "", $authorization);
            return $this->yammHelper->isValidAuthKey($authorizationKey);
        }
        return $result;
    }
}
