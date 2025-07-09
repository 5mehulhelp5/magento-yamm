<?php

namespace Mageserv\Yamm\Api\Data;

interface FetchRequestInterface
{
    const INCREMENT_ID = "increment_id";
    const MOBILE_NUMBER = "mobile_number";
    const EMAIL = "email";

    /**
     * @return string
     */
    public function getIncrementId();

    /**
     * @return string|null
     */
    public function getMobileNumber();

    /**
     * @return string|null
     */
    public function getEmail();

    /**
     * @param string $increment_id
     * @return $this
     */
    public function setIncrementId($increment_id);

    /**
     * @param string|null $mobile_number
     * @return $this
     */
    public function setMobileNumber($mobile_number);

    /**
     * @param string|null $email
     * @return $this
     */
    public function setEmail($email);
}
