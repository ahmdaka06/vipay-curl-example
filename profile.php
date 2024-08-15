<?php

require_once 'vipayment.class.php';

// API ID
$api_id = 'YOUR_API_ID';
// API Key
$api_key = 'YOUR_API_KEY';

// Create new instance
$vipayment = new VIPayment($api_id, $api_key);

// Profile

$profile = $vipayment->profile();

if ($profile['status']) {
    echo 'Name: ' . $profile['data']['name'] . '<br>';
    echo 'Email: ' . $profile['data']['email'] . '<br>';
    echo 'Balance: ' . $profile['data']['balance'] . '<br>';
    echo 'Message: ' . $profile['message'] . '<br>';
} else {
    echo 'Error: ' . $profile['message'] . '<br>';
}