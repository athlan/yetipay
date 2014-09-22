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
