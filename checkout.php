<?php

/**
 * A sample code to illustrate how a payment request will be made from 
 * "qbrando" in the checkout process. 
 *
 * This sample is only for illustration and hasn't been tested yet.
 * 
 * @author Kareem Mohamed <kareem3d.a@gmail.com> 
 */

require __DIR__ . '/functions.php';

/**
 * The following are the variables passed from the checkout process
 */
$amount = 100.50;
$currency = 'EGP';
$orderInfo = 'ORDER34524';

/**
 * Our merchant account configurations.. How to acquire those?
 *
 * This data will be encrypted and saved securely in our database..
 */
$accountData = array(
    'merchant_id' => '?',
    'access_code' => '?',
    'secret'      => '?' 
);

/**
 * Query data..
 */
$queryData = array(
    'vpc_AccessCode' => $accountData['access_code'],
    'vpc_Merchant' => $accountData['merchant_id'],

    'vpc_Amount' => ($amount * 100) // Multiplying by 100 to convert to the smallest unit
    'vpc_OrderInfo' => $orderInfo,

    'vpc_MerchTxnRef' => generateMerchTxnRef(), // See functions.php file

    'vpc_Command' => 'pay',
    'vpc_Locale' => 'ar',
    'vpc_Version' => 1,
    'vpc_ReturnURL' => 'http://www.qbrando.com/return_url.php',

    'vpc_SecureHashType' => 'SHA256'
);

// Add secure secret after hashing
$queryData['vpc_SecureHash'] = generateSecureHash($accountData['secret'], $queryData); // See functions.php file

// 
$migsUrl = 'https://migs.mastercard.com.au/vpcpay?'.http_build_query($queryData);

// Redirect to the bank website to continue the 
header("Location: " . $migsUrl);