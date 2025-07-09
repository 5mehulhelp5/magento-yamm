<?php

namespace Mageserv\Yamm\Api;

interface StoreManagementInterface
{
    /**
     * Get all store views with their languages
     *
     * @return \Mageserv\Yamm\Api\Data\StoreViewInterface[]
     */
    public function getList();
}
