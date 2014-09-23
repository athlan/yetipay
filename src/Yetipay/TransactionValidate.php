<?php

namespace Yetipay;

use GuzzleHttp\Client as HttpClient;

class TransactionValidate
{
    /**
     * @var Client
     */
    private $client;
    
    /**
     * @var GuzzleHttp\Client
     */
    private $httpClient;
    
    /**
     * @var string
     */
    private $urlValidate = 'https://www.yetipay.pl/YetiPay/my/status';
    
    /**
     * 
     * @param Client $client
     * @param GuzzleHttp\Client $httpClient
     */
    public function __construct(Client $client, HttpClient $httpClient = null) {
        $this->client = $client;
        $this->httpClient = $httpClient;
    }
    
    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if(null === $this->httpClient) {
            $this->httpClient = new HttpClient();
        }
        
        return $this->httpClient;
    }

    /**
     * @param \GuzzleHttp\Client $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return the $urlValidate
     */
    public function getUrlValidate()
    {
        return $this->urlValidate;
    }

    /**
     * @param string $urlValidate
     */
    public function setUrlValidate($urlValidate)
    {
        $this->urlValidate = $urlValidate;
    }

    public function validateTransaction($transactionId) {
        $postfields = array(
            'merchant_id' => $this->client->getMerchantId(),
            'transaction_id' => $transactionId,
            'time' => time(),
            'type' => 'json',
        );
        $postfields['hash'] = $this->generateHash($postfields);
        
        $response = $this->getHttpClient()->post($this->urlValidate, array(
            'body' => $postfields,
        ));
        
        $responseData = $response->json();
        $result = $responseData;
        
        unset($result['time'], $result['data']);
        
        return $result;
    }
    
    /**
     * 
     * @param array $params
     * @return string MD5 hash
     */
    public function generateHash(array $params) {
        $hashParams = array();
        
        if(isset($params['merchant_id'])) {
            $hashParams[] = $params['merchant_id'];
        }
        
        if(isset($params['transaction_id'])) {
            $hashParams[] = $params['transaction_id'];
        }
        
        if(isset($params['time'])) {
            $hashParams[] = $params['time'];
        }
        
        return $this->client->generateHashRequest($hashParams);
    }
    
    /**
     * 
     * @param string $hash
     * @param array $params
     * @return boolean
     */
    public function validateHash($hash, array $params) {
        return $hash === $this->generateHash($params);
    }
}
