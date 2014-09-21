<?php

namespace Yetipay;

class PaymentButtonCodeGenerator
{
    /**
     * @var Client
     */
    private $client;
    
    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    /**
     * Generates html code from PaymentButton object.
     * 
     * @param PaymentButton $button
     * @param int $buttonLayout
     */
    public function getButtonCode(PaymentButton $button, $buttonLayout = 0) {
        $attr = array(
            'merchant_id' => $this->client->getMerchantId(),
            'amount' => $button->getAmount(),
            'descr' => $button->getDescription(),
            'time' => time(),
        );
        $hashParams = $attr;
        
        if($button->getOrderId()) {
            $attr['order_id'] = $button->getOrderId();
            $hashParams['order_id'] = $button->getOrderId();
        }
        
        if($button->getProductId()) {
            $attr['product_id'] = $button->getProductId();
            $hashParams['product_id'] = $button->getProductId();
        }
        
        if($button->getUserId()) {
            $attr['user_id'] = $button->getUserId();
            $hashParams['user_id'] = $button->getUserId();
        }
        
        if($button->getReturnUrl()) {
            $attr['url'] = $button->getReturnUrl();
            $hashParams['url'] = $button->getReturnUrl();
        }
        
        $attr['restricted'] = (int) $button->isRestricted();
        $hashParams['restricted'] = (int) $button->isRestricted();
        
        $hash = $this->generateHash($hashParams);
        $attr['hash'] = $hash;
        
        $code = '<yp:paymentButton';
        
        foreach ($attr as $key => $val) {
            $code .= ' ' . $key . '="' . $val . '"';
        }
        
        $code .= '></yp:paymentButton>';
        
        return $code;
    }
    
    /**
     * 
     * @param PaymentButton $button
     * @return string
     */
    public function generateHash(array $params) {
        $hashParams = array(
            'merchant_id' => $this->client->getMerchantId(),
            'amount' => $params['amount'],
            'descr' => $params['descr'],
        );
        
        if(isset($params['order_id'])) {
            $hashParams['order_id'] = $params['order_id'];
        }
        
        if(isset($params['product_id'])) {
            $hashParams['product_id'] = $params['product_id'];
        }
        
        if(isset($params['user_id'])) {
            $hashParams['user_id'] = $params['user_id'];
        }
        
        if(isset($params['url'])) {
            $hashParams['url'] = $params['url'];
        }
        
        if(isset($params['restricted'])) {
            $hashParams['restricted'] = (int)(bool)$params['restricted'];
        }
        
        $hashParams['time'] = $params['time'];
        
        return $this->client->generateHashRequest(array_values($hashParams));
    }
}
