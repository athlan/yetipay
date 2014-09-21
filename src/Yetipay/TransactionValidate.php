<?php

namespace Yetipay;

class TransactionValidate
{
    /**
     * @var Client
     */
    private $client;
    
    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    public function validateTransaction($transactionId) {
        $postfields = array(
            'merchant_id' => $this->client->getMerchantId(),
            'transaction_id' => $transactionId,
            'time' => time(),
        );
        $postfields['hash'] = $this->generateHash($postfields);
        
        
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
        
        return $this->client->generateHashRequest($sortedParamsValues);
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
