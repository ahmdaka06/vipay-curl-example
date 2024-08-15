<?php

require_once 'vipayment.class.php';

// API ID
$api_id = 'YOUR_API_ID';
// API Key
$api_key = 'YOUR_API_KEY';

// Create new instance
$vipayment = new VIPayment($api_id, $api_key);

// Order Prepaid

$order_prepaid = $vipayment->order_prepaid('PLN', '081234567890');
$order_prepaid = $vipayment->order_prepaid(
    'PLN',
    '081234567890'
);

if ($order_prepaid['status']) {
    echo 'TRX ID: ' . $order_prepaid['data']['trxid'] . '<br>';
    echo 'Service Code: ' . $order_prepaid['data']['code'] . '<br>';
    echo 'Data: ' . $order_prepaid['data']['data_no'] . '<br>';
    echo 'Price: ' . $order_prepaid['data']['price'] . '<br>';
    echo 'Note: ' . $order_prepaid['data']['note'] . '<br>';
    echo 'Last Balance: ' . $order_prepaid['data']['balance'] . '<br>';
    echo 'Message: ' . $order_prepaid['message'] . '<br>';
} else {
    echo 'Error: ' . $order_prepaid['message'] . '<br>';
}

// Status Order Prepaid

// With parameter trxid
$status_order_prepaid = $vipayment->status_order_prepaid('TRX_ID');

if ($status_order_prepaid['status']) {
    echo 'TRX ID: ' . $status_order_prepaid['data'][0]['trxid'] . '<br>';
    echo 'Service Code: ' . $status_order_prepaid['data'][0]['code'] . '<br>';
    echo 'Data: ' . $status_order_prepaid['data'][0]['data_no'] . '<br>';
    echo 'Price: ' . $status_order_prepaid['data'][0]['price'] . '<br>';
    echo 'Note: ' . $status_order_prepaid['data'][0]['note'] . '<br>';
    echo 'Message: ' . $status_order_prepaid['message'] . '<br>';
} else {
    echo 'Error: ' . $status_order_prepaid['message'] . '<br>';
}

// With parameter trxid and limit

$status_order_prepaid = $vipayment->status_order_prepaid('TRX_ID', 5);
if ($status_order_prepaid['status']) {
    foreach ($status_order_prepaid['data'] as $data) {
        echo 'TRX ID: ' . $data['trxid'] . '<br>';
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Data: ' . $data['data_no'] . '<br>';
        echo 'Price: ' . $data['price'] . '<br>';
        echo 'Note: ' . $data['note'] . '<br>';
        echo 'Message: ' . $status_order_prepaid['message'] . '<br>';
    }
} else {
    echo 'Error: ' . $status_order_prepaid['message'] . '<br>';
}

// Service Prepaid

// without parameter filter_type and filter_value
$service_prepaid = $vipayment->service_prepaid();

if ($service_prepaid['status']) {
    foreach ($service_prepaid['data'] as $data) {
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Service Type: ' . $data['type'] . '<br>';
        echo 'Service Category: ' . $data['category'] . '<br>';
        echo 'Service Prepost: ' . $data['prepost'] . '<br>';
        echo 'Service Brand: ' . $data['brand'] . '<br>';
        echo 'Service Name: ' . $data['name'] . '<br>';
        echo 'Service Note: ' . $data['note'] . '<br>';
        echo 'Price Basic: ' . $data['price']['basic'] . '<br>';
        echo 'Price Premium: ' . $data['price']['premium'] . '<br>';
        echo 'Price Special: ' . $data['price']['special'] . '<br>';
        echo 'Service Status: ' . $data['status'] . '<br>';
        echo 'Message: ' . $service_prepaid['message'] . '<br>';
    }
} else {
    echo 'Error: ' . $service_prepaid['message'] . '<br>';
}

// with parameter filter_type and filter_value
$service_prepaid = $vipayment->service_prepaid('type', 'pulsa-reguler');
if ($service_prepaid['status']) {
    foreach ($service_prepaid['data'] as $data) {
        echo 'Service Code: ' . $data['code'] . '<br>';
        echo 'Service Type: ' . $data['type'] . '<br>';
        echo 'Service Category: ' . $data['category'] . '<br>';
        echo 'Service Prepost: ' . $data['prepost'] . '<br>';
        echo 'Service Brand: ' . $data['brand'] . '<br>';
        echo 'Service Name: ' . $data['name'] . '<br>';
        echo 'Service Note: ' . $data['note'] . '<br>';
        echo 'Price Basic: ' . $data['price']['basic'] . '<br>';
        echo 'Price Premium: ' . $data['price']['premium'] . '<br>';
        echo 'Price Special: ' . $data['price']['special'] . '<br>';
        echo 'Service Status: ' . $data['status'] . '<br>';
        echo 'Message: ' . $service_prepaid['message'] . '<br>';
    }
} else {
    echo 'Error : ' . $service_prepaid['message'] . '<br>';
}
?>