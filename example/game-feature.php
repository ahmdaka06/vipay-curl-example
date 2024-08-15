<?php

require_once 'vipayment.class.php';

// API ID
$api_id = 'YOUR_API_ID';
// API Key
$api_key = 'YOUR_API_KEY';

// Create new instance
$vipayment = new VIPayment($api_id, $api_key);

// Order Game Feature & Streaming

// with parameter data_zone
$order_game = $vipayment->order_game('ML5_0-S10', '111111', '1111');

if ($order_game['status']) {
    echo 'TRX ID: ' . $order_game['data']['trxid'] . '<br>';
    echo 'Service Code: ' . $order_game['data']['code'] . '<br>';
    echo 'Data: ' . $order_game['data']['data_no'] . '<br>';
    echo 'Data Zone: ' . $order_game['data']['data_zone'] . '<br>';
    echo 'Price: ' . $order_game['data']['price'] . '<br>';
    echo 'Note: ' . $order_game['data']['note'] . '<br>';
    echo 'Last Balance: ' . $order_game['data']['balance'] . '<br>';
    echo 'Message: ' . $order_game['message'] . '<br>';
} else {
    echo 'Error: ' . $order_game['message'] . '<br>';
}

// without parameter data_zone
$order_game = $vipayment->order_game('FF5-S24', '111111');

if ($order_game['status']) {
    echo 'TRX ID: ' . $order_game['data']['trxid'] . '<br>';
    echo 'Service Code: ' . $order_game['data']['code'] . '<br>';
    echo 'Data: ' . $order_game['data']['data_no'] . '<br>';
    echo 'Price: ' . $order_game['data']['price'] . '<br>';
    echo 'Note: ' . $order_game['data']['note'] . '<br>';
    echo 'Last Balance: ' . $order_game['data']['balance'] . '<br>';
    echo 'Message: ' . $order_game['message'] . '<br>';
} else {
    echo 'Error: ' . $order_game['message'] . '<br>';
}

// Status Order Game & Streaming

// With parameter trxid
$status_order_game = $vipayment->status_order_game('TRX_ID');

if ($status_order_game['status']) {
    echo 'TRX ID: ' . $status_order_game['data'][0]['trxid'] . '<br>';
    echo 'Service Code: ' . $status_order_game['data'][0]['code'] . '<br>';
    echo 'Data: ' . $status_order_game['data'][0]['data_no'] . '<br>';
    echo 'Price: ' . $status_order_game['data'][0]['price'] . '<br>';
    echo 'Note: ' . $status_order_game['data'][0]['note'] . '<br>';
    echo 'Message: ' . $status_order_game['message'] . '<br>';
} else {
    echo 'Error: ' . $status_order_game['message'] . '<br>';
}

// With parameter trxid and limit

$status_order_game = $vipayment->status_order_game('TRX_ID', 5);

if ($status_order_game['status']) {
    foreach ($status_order_game['data'] as $data) {
        echo 'TRX ID: ' . $data['trxid'] . '<br>';
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Data: ' . $data['data_no'] . '<br>';
        echo 'Price: ' . $data['price'] . '<br>';
        echo 'Note: ' . $data['note'] . '<br>';
        echo 'Message: ' . $status_order_game['message'] . '<br>';
    }
} else {
    echo 'Error: ' . $status_order_game['message'] . '<br>';
}

// Service Game & Streaming

// without parameter filter_type, filter_value and filter status

$service_game = $vipayment->service_game();

if ($service_game['status']) {
    foreach ($service_game['data'] as $data) {
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Service Game / Streaming: ' . $data['game'] . '<br>';
        echo 'Service Name: ' . $data['name'] . '<br>';
        echo 'Price Basic: ' . $data['price']['basic'] . '<br>';
        echo 'Price Premium: ' . $data['price']['premium'] . '<br>';
        echo 'Price Special: ' . $data['price']['special'] . '<br>';
        echo 'Server: ' . $data['server'] . '<br>';
        echo 'Note: ' . $data['note'] . '<br>';
        echo 'Message: ' . $service_game['message'] . '<br>';
    }
} else {
    echo 'Error: ' . $service_game['message'] . '<br>';
}

// with parameter filter_type, filter_value, and filter status

$service_game = $vipayment->service_game('game', 'Mobile Legend', 'available');

if ($service_game['status']) {
    foreach ($service_game['data'] as $data) {
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Service Game / Streaming: ' . $data['game'] . '<br>';
        echo 'Service Name: ' . $data['name'] . '<br>';
        echo 'Price Basic: ' . $data['price']['basic'] . '<br>';
        echo 'Price Premium: ' . $data['price']['premium'] . '<br>';
        echo 'Price Special: ' . $data['price']['special'] . '<br>';
        echo 'Server: ' . $data['server'] . '<br>';
        echo 'Note: ' . $data['note'] . '<br>';
        echo 'Message: ' . $service_game['message'] . '<br>';
    }
} else {
    echo 'Error: ' . $service_game['message'] . '<br>';
}




