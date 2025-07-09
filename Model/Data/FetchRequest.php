<?php
/**
 * FetchRequest
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\FetchRequestInterface;

class FetchRequest extends DataObject implements FetchRequestInterface
{
    /**
     * @inheirtdoc
     */
    public function getIncrementId()
    {
        return $this->_getData(self::INCREMENT_ID);
    }
    /**
     * @inheirtdoc
     */
    public function getMobileNumber()
    {
        return $this->_getData(self::MOBILE_NUMBER);
    }
    /**
     * @inheirtdoc
     */
    public function getEmail()
    {
        return $this->_getData(self::EMAIL);
    }
    /**
     * @inheirtdoc
     */
    public function setIncrementId($increment_id)
    {
        return $this->setData(self::INCREMENT_ID, $increment_id);
    }
    /**
     * @inheirtdoc
     */
    public function setMobileNumber($mobile_number)
    {
        return $this->setData(self::MOBILE_NUMBER, $mobile_number);
    }
    /**
     * @inheirtdoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }
}
