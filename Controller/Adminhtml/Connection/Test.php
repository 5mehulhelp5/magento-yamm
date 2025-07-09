<?php
/**
 * TestConnection
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Controller\Adminhtml\Connection;


use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Config\Model\ResourceModel\Config as ModelConfig;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\Serializer\Json;
use Mageserv\Yamm\Helper\Yamm as YammHelper;

/**
 * Class TestConnection
 * @package Mageplaza\Smtp\Controller\Adminhtml\Smtp
 */
class Test extends Action implements CsrfAwareActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mageserv_Yamm::configuration';

    /**
     * @var YammHelper
     */
    protected $yammHelper;

    /**
     * @var Json
     */
    protected $serializer;
    protected $modelConfig;

    /**
     * TestConnection constructor.
     *
     * @param Context $context
     * @param YammHelper $yammHelper
     * @paarm Json $serializer
     */
    public function __construct(
        Context $context,
        YammHelper $yammHelper,
        Json $serializer,
        ModelConfig $modelConfig
    ) {
        $this->yammHelper = $yammHelper;
        $this->serializer = $serializer;
        $this->modelConfig = $modelConfig;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        try {
            $result    = [
                'status'  => true,
                'content' => __('Account successfully connected')
            ];
            $apiKey     = trim($this->getRequest()->getParam('apiKey'));
            $apiEnvironment = $this->getRequest()->getParam('apiEnvironment');
            $isSuccess   = $this->yammHelper->testConnection($apiKey, $apiEnvironment);
            if(!$isSuccess)
                throw new LocalizedException(__("Cannot Connect"));
        } catch (Exception $e) {
            $result = [
                'status'  => false,
                'content' => __('Can\'t connect to Yamm server.')
            ];
        }

        return $this->getResponse()->representJson($this->serializer->serialize($result));
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
