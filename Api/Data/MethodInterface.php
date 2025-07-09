<?php

namespace Mageserv\Yamm\Api\Data;

interface MethodInterface
{
    const CODE = 'code';
    const TITLE = 'title';
    /**
     * Get payment method code
     *
     * @return string
     */
    public function getCode();

    /**
     * Get payment method title
     *
     * @return string
     */
    public function getTitle();
    /**
     * Get payment method code
     * @param $code
     * @return $this
     */
    public function setCode($code);

    /**
     * Get payment method title
     *
     * @param $title
     * @return $this
     */
    public function setTitle($title);
}
