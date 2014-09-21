<?php

namespace Yetipay;

class Client
{
    /**
     * Yetipay Mearchant ID
     * 
     * @var int
     */
    private $merchantId;
    
    /**
     * Yetipay Auth Key 1 to sign requests sent from Client to Yetipay.
     *
     * @var string
     */
    private $authKey1;
    
    /**
     * Yetipay Auth Key 2 to sign requests sent from Yetipay to Client.
     *
     * @var string
     */
    private $authKey2;

	  /**
     * @param int $merchantId Yetipay Mearchant ID
     * @param string $authKey1 Yetipay Auth Key 1 to sign requests sent from Client to Yetipay.
     * @param string $authKey2 Yetipay Auth Key 2 to sign requests sent from Yetipay to Client.
     */
    public function __construct($merchantId, $authKey1, $authKey2) {
        $this->merchantId = $merchantId;
        $this->authKey1 = $authKey1;
        $this->authKey2 = $authKey2;
    }
    
    /**
     * @return the $merchantId
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }
    
    /**
     * @return the $authKey1
     */
    public function getAuthKey1()
    {
        return $this->authKey1;
    }
    
    /**
     * @return the $authKey2
     */
    public function getAuthKey2()
    {
        return $this->authKey2;
    }
    
    /**
     * Generates hash used for communication form Client to Yetipay
     * 
     * @param array $sortedParamsValues
     * @return string
     */
    public function generateHashRequest(array $sortedParamsValues) {
        $sortedParamsValues[] = $this->getAuthKey1();
        return md5(join('', $sortedParamsValues));
    }
    
    /**
     * Generates hash used for communication form Yetipay to Client
     * 
     * @param array $sortedParamsValues
     * @return string
     */
    public function generateHashResponse(array $sortedParamsValues) {
        $sortedParamsValues[] = $this->getAuthKey2();
        return md5(join('', $sortedParamsValues));
    }
}
