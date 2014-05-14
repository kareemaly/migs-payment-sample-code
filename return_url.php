<?php

/**
 * A sample code to illustrate how a payment response will be handled.
 *
 * This sample is only for illustration and hasn't been tested yet.
 * 
 * @author Kareem Mohamed <kareem3d.a@gmail.com> 
 */

require __DIR__ . '/functions.php';

$transaction['status'] = getInput('vpc_TxnResponseCode');
$transaction['key']    = getInput('vpc_TransactionNo');
$transaction['message'] = getInput('vpc_Message');

// $reference = getInput('vpc_MerchTxnRef');
// Get order from the database by the `$reference` generated random number in the request process

if($transaction['status'] == "0" && $transaction['message'] == "Approved") {

    // Save transaction information in the database
    // Display transaction details
} else {

    // Display error
}