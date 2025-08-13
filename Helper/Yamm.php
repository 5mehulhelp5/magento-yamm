<?php
/**
 * Yamm
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */

namespace Mageserv\Yamm\Helper;



use Laminas\Http\Request;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Component\ComponentRegistrarInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Mageserv\Yamm\Model\Config\Source\ApiEnvironment;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class Yamm extends Data
{
    const IS_CONNECTED_XML_PATH = "yamm_refunds/api_configuration/is_connected";
    const ENVIRONMENT_XML_PATH = "yamm_refunds/api_configuration/api_environment";
    const API_TOKEN_XML_PATH = "yamm_refunds/api_configuration/api_token";
    const LOG_ENABLED_XML_PATH = "yamm_refunds/api_configuration/log_enabled";
    const STAGING_API_URL = "https://integration.yammrefund.com/magento/";
    const PRODUCTION_API_URL = "https://integration.yamm.sa/magento/";
    protected $client;
    protected $json;
    protected $logger;
    protected $configWriter;
    public function __construct(
        Context $context,
        DirectoryList $directoryList,
        ComponentRegistrarInterface $componentRegistrar,
        CurlFactory $client,
        Json $json,
        LoggerInterface $logger,
        WriterInterface $configWriter
    )
    {
        parent::__construct($context, $directoryList, $componentRegistrar);
        $this->client = $client;
        $this->json = $json;
        $this->logger = $logger;
        $this->configWriter = $configWriter;
    }
    protected function getApiUrl()
    {
        $isStaging = $this->scopeConfig->getValue(
            self::ENVIRONMENT_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
        return $isStaging == ApiEnvironment::SANDBOX_ENVIRONMENT ? self::STAGING_API_URL : self::PRODUCTION_API_URL;
    }
    public function isLogEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::LOG_ENABLED_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }
    protected function getApiToken()
    {
        return $this->scopeConfig->getValue(
            self::API_TOKEN_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }

    public function syncData(
        $data = [],
        $headers = [],
        $requestMethod = Request::METHOD_POST
    )
    {
        $url = $this->getApiUrl() . "webhook";
        return $this->buildClient(
            $url,
            $requestMethod,
            $data,
            $headers
        );
    }
    public function getAccountInfo()
    {
        $url = $this->getApiUrl() . "store-analytics";
        $response = $this->buildClient(
            $url
        );
        if(is_array($response) && !empty($response['status_code'])){
            if ($response['status_code'] == 200) {
                return $response['body']['records'];
            }
            if(!empty($response['body']['errors']) && !empty($response['body']['errors'][0]['message']))
                throw new LocalizedException($response['errors'][0]['message']);
        }
        throw new LocalizedException(__("Cannot connect to Yamm Server. Please check your configuration"));
    }
    public function connectStore($apiKey, $apiEnvironment){
        $url = $apiEnvironment == ApiEnvironment::SANDBOX_ENVIRONMENT ? self::STAGING_API_URL : self::PRODUCTION_API_URL;
        $url .= "store-analytics";
        try{
            $client = $this->client->create();
            $requestHeaders = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey
            ];
            $client->setHeaders($requestHeaders);
            $client->post($url,  $this->json->serialize([
                "base_uri" => $this->_urlBuilder->getBaseUrl(['type' => UrlInterface::URL_TYPE_LINK])
            ]));
            try{
                $response = $this->json->unserialize($client->getBody());
            }catch (\Exception $exception){
                $response = $client->getBody();
            }
            if ($client->getStatus() == 200 && !empty($response['success'])) {
                $this->configWriter->save(
                    self::IS_CONNECTED_XML_PATH,
                    1
                );
                return true;
            }
            return false;
        }catch (\Exception $exception){
            $this->logger->critical( $exception->getMessage() );
        }
        return false;
    }
    /**
     * @param $apiKey
     * @param $apiEnvironment
     * @return bool
     */
    public function testConnection($apiKey, $apiEnvironment){
        $url = $apiEnvironment == ApiEnvironment::SANDBOX_ENVIRONMENT ? self::STAGING_API_URL : self::PRODUCTION_API_URL;
        $url .= "store-analytics";
        try{
            $client = $this->client->create();
            $requestHeaders = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey
            ];
            $client->setHeaders($requestHeaders);
            $client->get($url);
            try{
                $response = $this->json->unserialize($client->getBody());
            }catch (\Exception $exception){
                $response = $client->getBody();
            }
            if ($client->getStatus() == 200 && !empty($response['success'])) {
                $this->connectStore($apiKey, $apiEnvironment);
                return true;
            }
            return false;
        }catch (\Exception $exception){
            $this->logger->critical( $exception->getMessage() );
        }
        return false;
    }
    protected function buildClient($url, $method = Request::METHOD_GET, array $data = [], array $headers = [] )
    {
        try{
            /** @var Curl $client */
            $client = $this->client->create();
            $requestHeaders = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getApiToken()
            ];
            if(!empty($headers)){
                $requestHeaders = array_merge($requestHeaders, $headers);
            }
            $client->setHeaders($requestHeaders);
            if($method == Request::METHOD_POST){
               $client->post(
                   $url,
                   $this->json->serialize($data)
               );
            }elseif($method == Request::METHOD_GET){
                if($data)
                    $url .= http_build_query($data);

                $client->get($url);
            }

            try{
                $response = $this->json->unserialize($client->getBody());
            }catch (\Exception $exception){
                $response = $client->getBody();
            }
            return [
                'status_code' => $client->getStatus(),
                'body' => $response
            ];
        }catch (\Exception $exception){
            $this->logger->critical( $exception->getMessage() );
        }
        return null;
    }

    /**
     * Validate authorization key
     * @param string $authorizationKey
     * @return bool
     */
    public function isValidAuthKey($authorizationKey)
    {
        return $this->isModuleEnabled() && $this->getApiToken() === $authorizationKey;
    }

    public function isConnected()
    {
        return $this->scopeConfig->isSetFlag(
            self::IS_CONNECTED_XML_PATH,
            ScopeInterface::SCOPE_STORE
        );
    }
}
