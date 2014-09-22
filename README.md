Yetipay PHP Client library
===

This library allows to easy integration with [yetipay](https://www.yetipay.pl/) payments.

## Features

* Generated payment button
* Handles pingback (`URL_STATUS`)
* Verifies payments

## Installation

### Composer

Add dependency in `composer.json` file:

```
{
    "require": {
        "athlan/yetipay": "1.*"
    }
}
```

## Examples

### Handle pingback  (`URL_STATUS`)

```php
<?php 

use Yetipay as Yetipay;

$merchantId = '';
$authKey1 = '';
$authKey2 = '';

$yetipay = new Yetipay\Client($merchantId, $authKey1, $authKey2);
$pingback = new Yetipay\TransactionPingback($yetipay);

$params = $_POST; // or more proper way in frameworks, from Request object

if($pingback->validateHash($params['hash'], $params)) {
    // activate product here
    
    die('ACK'); // yetipay expects "ACK" string in response to confirm transaction
}

die('FAILED');

```

### Generate payment button

```php
<?php

use Yetipay as Yetipay;

$merchantId = '';
$authKey1 = '';
$authKey2 = '';

$yetipay = new Yetipay\Client($merchantId, $authKey1, $authKey2);

$amount = 5;
$description = 'Test payment';

$button = new Yetipay\PaymentButton($amount, $description);
$button->setUserId('userid_here');
$button->setProductId('productid_here');
$button->setReturnUrl('http://localhost/validate-transaction.php?transactionId=%transactionId%');

$buttonGenerator = new Yetipay\PaymentButtonCodeGenerator($yetipay);

?><html xmlns:yp="https://www.yetipay.pl">

<head>
  <script type="text/javascript" src="https://www.yetipay.pl/payments/js/316/yetixd.js"></script>
</head>
<body>
  
  <?php echo $buttonGenerator->getButtonCode($button) ?>
</body>

</html>
```

### Validate payment

```<?php 

use Yetipay as Yetipay;

$merchantId = '';
$authKey1 = '';
$authKey2 = '';

$yetipay = new Yetipay\Client($merchantId, $authKey1, $authKey2);
$pingback = new Yetipay\TransactionValidate($yetipay);

$transactionId = $_GET['transactionId']; // or more proper way in frameworks, from Request object
$data = $pingback->validateTransaction($transactionId);

if($data['status'] == 200) {
    // activte product here
}

```
