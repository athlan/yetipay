<?php 

use Yetipay as Yetipay;

$merchantId = '';
$authKey1 = '';
$authKey2 = '';

$yetipay = new Yetipay\Client($merchantId, $authKey1, $authKey2);
$pingback = new Yetipay\TransactionValidate($yetipay);

$transactionId = $_GET['transactionId'];
$data = $pingback->validateTransaction($transactionId);

if($data['status'] == 200) {
    // activte product here
}
