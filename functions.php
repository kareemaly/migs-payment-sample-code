<?php

/**
 * Simple interface for $_GET
 * @param  string  $key     
 * @param  boolean $default 
 * @return mixed           
 */
function getInput($key, $default = false)
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}


/**
 * A simple algorithm to generate a random reference to the order
 * @return string
 */
function generateMerchTxnRef()
{
    $txnRef = rand(99999999, 9999999999999999);

    // Saved in the database associated with the order id

    return $txnRef;
}

/**
 * Generate secure hash from url params
 * Tested with the example provided in the pdf (page 74)
 * 
 * @param  array $params
 * @return string
 */
function generateSecureHash($secret, array $params)
{
    $secureHash = "";

    // Sorting params first based on the keys
    ksort($params);
    
    foreach ($params as $key => $value)
    {        
        // Check if key equals to vpc_SecureHash or vpc_SecureHashType to discard it
        if(in_array($key, array('vpc_SecureHash', 'vpc_SecureHashType'))) continue;

        // If key either starts with vpc_ or user_
        if(substr( $key, 0, 4 ) === "vpc_" || substr($key, 0, 5) === "user_") {

            $secureHash .= $key."=".urlencode($value)."&";
        }
    }

    // Remove the last `&` character from string
    $secureHash = rtrim($secureHash, "&");

    //
    return strtoupper(hash_hmac('sha256', $secureHash, pack('H*', $secret)));
}