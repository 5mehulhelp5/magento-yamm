<?php
/**
 * Response
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Model\Data;


use Magento\Framework\DataObject;
use Mageserv\Yamm\Api\Data\ResponseInterface;

class Response extends DataObject implements ResponseInterface
{

    /**
     * @inheirtdoc
     */
    public function getEventType()
    {
        return $this->_getData(self::EVENT_TYPE);
    }

    /**
     * @inheirtdoc
     */
    public function setEventType($eventType)
    {
        return $this->setData(self::EVENT_TYPE, $eventType);
    }

    /**
     * @inheirtdoc
     */
    public function getEventData()
    {
        return $this->_getData(self::EVENT_DATA);
    }
    /**
     * @inheirtdoc
     */
    public function setEventData($data)
    {
        return $this->setData(self::EVENT_DATA, $data);
    }
}
