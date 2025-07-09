<?php
/**
 * Customer
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\CustomerInterface;

class Customer extends DataObject implements CustomerInterface
{
    /**
     * @inheritdoc
     */
    public function getStoreCustomerId()
    {
        return $this->_getData(self::STORE_CUSTOMER_ID);
    }

    /**
     * @inheritdoc
     */
    public function setStoreCustomerId($storeId)
    {
        return $this->setData(self::STORE_CUSTOMER_ID, $storeId);
    }

    /**
     * @inheritdoc
     */
    public function getFirstName()
    {
        return $this->_getData(self::FIRST_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setFirstName($firstName)
    {
        return $this->setData(self::FIRST_NAME, $firstName);
    }

    /**
     * @inheritdoc
     */
    public function getLastName()
    {
        return $this->_getData(self::LAST_NAME);
    }

    /**
     * @inheritdoc
     */
    public function setLastName($lastName)
    {
        return $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * @inheritdoc
     */
    public function getMobile()
    {
        return $this->_getData(self::MOBILE);
    }

    /**
     * @inheritdoc
     */
    public function setMobile($mobile)
    {
        return $this->setData(self::MOBILE, $mobile);
    }

    /**
     * @inheritdoc
     */
    public function getMobileCode()
    {
        return $this->_getData(self::MOBILE_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setMobileCode($mobileCode)
    {
        return $this->setData(self::MOBILE_CODE, $mobileCode);
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->_getData(self::EMAIL);
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritdoc
     */
    public function getBirthday()
    {
        return $this->_getData(self::BIRTHDAY);
    }

    /**
     * @inheritdoc
     */
    public function setBirthday($birthday)
    {
        return $this->setData(self::BIRTHDAY, $birthday);
    }

    /**
     * @inheritdoc
     */
    public function getGender()
    {
        return $this->_getData(self::GENDER);
    }

    /**
     * @inheritdoc
     */
    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    /**
     * @inheritdoc
     */
    public function getCity()
    {
        return $this->_getData(self::CITY);
    }

    /**
     * @inheritdoc
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**
     * @inheritdoc
     */
    public function getCountry()
    {
        return $this->_getData(self::COUNTRY);
    }

    /**
     * @inheritdoc
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @inheritdoc
     */
    public function getCountryCode()
    {
        return $this->_getData(self::COUNTRY_CODE);
    }

    /**
     * @inheritdoc
     */
    public function setCountryCode($countryCode)
    {
        return $this->setData(self::COUNTRY_CODE, $countryCode);
    }

    /**
     * @inheritdoc
     */
    public function getLocation()
    {
        return $this->_getData(self::LOCATION);
    }

    /**
     * @inheritdoc
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * @inheritdoc
     */
    public function getStoreUpdatedAt()
    {
        return $this->_getData(self::STORE_UPDATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setStoreUpdatedAt($updatedAt)
    {
        return $this->setData(self::STORE_UPDATED_AT, $updatedAt);
    }
}
