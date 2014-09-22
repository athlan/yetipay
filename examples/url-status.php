<?php 

use Yetipay as Yetipay;

$merchantId = '';
$authKey1 = '';
$authKey2 = '';

$yetipay = new Yetipay\Client($merchantId, $authKey1, $authKey2);
$pingback = new Yetipay\TransactionPingback($yetipay);

$params = $_POST;

if($pingback->validateHash($params['hash'], $params)) {
    // activate product here
    
    die('ACK');
}

die('FAILED');
