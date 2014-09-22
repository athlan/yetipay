<?php

namespace Yetipay;

class TransactionPingback
{
    /**
     * @var Client
     */
    private $client;
    
    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    /**
     * 
     * @param array $params
     * @return string MD5 hash
     */
    public function generateHash(array $params) {
        $hashParams = array();
        
        if(isset($params['transaction_id'])) {
            $hashParams[] = $params['transaction_id'];
        }
        
        if(isset($params['merchant_id'])) {
            $hashParams[] = $params['merchant_id'];
        }
        
        if(isset($params['order_id'])){
            $hashParams[] = $params['order_id'];
        }
        
        if(isset($params['product_id'])) {
            $hashParams[] = $params['product_id'];
        }
        
        if(isset($params['user_id'])) {
            $hashParams[] = $params['user_id'];
        }
        
        if(isset($params['amount'])) {
            $hashParams[] = $params['amount'];
        }
        
        if(isset($params['descr'])) {
            $hashParams[] = $params['descr'];
        }
        
        if(isset($params['client_ip'])) {
            $hashParams[] = $params['client_ip'];
        }
        
        if(isset($params['time'])) {
            $hashParams[] = $params['time'];
        }
        
        return $this->client->generateHashResponse($hashParams);
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
