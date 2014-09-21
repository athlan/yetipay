<?php

namespace Yetipay;

class PaymentButton
{
    /**
     * @var int
     */
    private $amount;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * @var string
     */
    private $orderId;
    
    /**
     * @var string
     */
    private $productId;
    
    /**
     * @var string
     */
    private $userId;
    
    /**
     * @var string
     */
    private $returnUrl;
    
    /**
     * @var string
     */
    private $productImage;
    
    /**
     * @var boolean
     */
    private $restricted;
    
    /**
     *
     * @param int $amount
     * @param string $description
     */
    public function __construct($amount, $description) {
        $this->amount = $amount;
        $this->description = $description;
        
        $this->orderId = '';
        $this->productId = '';
        $this->userId = '';
        $this->returnUrl = '';
        $this->productImage = '';
        $this->restricted = false;
    }
    
    /**
     * @return the $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

	  /**
     * @param number $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

	  /**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

	  /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

	  /**
     * @return the $orderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

	  /**
     * @param string $ordrId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

	  /**
     * @return the $productId
     */
    public function getProductId()
    {
        return $this->productId;
    }

	  /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

	  /**
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

	  /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

	  /**
     * @return the $returnUrl
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

	  /**
     * @param string $returnUrl
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

	  /**
     * @return the $productImage
     */
    public function getProductImage()
    {
        return $this->productImage;
    }

	  /**
     * @param string $productImage
     */
    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
    }

	  /**
     * @return the $restricted
     */
    public function isRestricted()
    {
        return $this->restricted;
    }

	  /**
     * @param boolean $restricted
     */
    public function setRestricted($restricted)
    {
        $this->restricted = (bool) $restricted;
    }
}
