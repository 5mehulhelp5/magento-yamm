<?php

namespace Mageserv\Yamm\Api\Data;

interface CustomerInterface
{
    const STORE_CUSTOMER_ID = 'store_customer_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const MOBILE = 'mobile';
    const MOBILE_CODE = 'mobile_code';
    const EMAIL = 'email';
    const BIRTHDAY = 'birthday';
    const GENDER = 'gender';
    const CITY = 'city';
    const COUNTRY = 'country';
    const COUNTRY_CODE = 'country_code';
    const LOCATION = 'location';
    const STORE_UPDATED_AT = 'store_updated_at';

    /**
     * @return int
     */
    public function getStoreCustomerId();

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreCustomerId($storeId);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getMobile();

    /**
     * @param string $mobile
     * @return $this
     */
    public function setMobile($mobile);

    /**
     * @return string
     */
    public function getMobileCode();

    /**
     * @param string $mobileCode
     * @return $this
     */
    public function setMobileCode($mobileCode);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getBirthday();

    /**
     * @param string $birthday
     * @return $this
     */
    public function setBirthday($birthday);

    /**
     * @return string
     */
    public function getGender();

    /**
     * @param string $gender
     * @return $this
     */
    public function setGender($gender);

    /**
     * @return string|null
     */
    public function getCity();

    /**
     * @param string|null $city
     * @return $this
     */
    public function setCity($city);

    /**
     * @return string|null
     */
    public function getCountry();

    /**
     * @param string|null $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * @return string|null
     */
    public function getCountryCode();

    /**
     * @param string|null $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode);

    /**
     * @return string|null
     */
    public function getLocation();

    /**
     * @param string|null $location
     * @return $this
     */
    public function setLocation($location);

    /**
     * @return string|null
     */
    public function getStoreUpdatedAt();

    /**
     * @param string|null $updatedAt
     * @return $this
     */
    public function setStoreUpdatedAt($updatedAt);
}
