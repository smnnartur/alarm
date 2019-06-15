<?php

require_once('vendor/autoload.php');
require "getOrderInfo.php";
require "common.php";

$client = new \RetailCrm\ApiClient(
    'https://shopbarn3.retailcrm.ru',
    'SPoxzehvJURp5VLB5cIgxYVx6nsKgA9Z',
    \RetailCrm\ApiClient::V5
);

$orderExternalId = $_GET['externalId'];

$url = 'https://shopbarn.ru/index.php?route=api/login';
$fields = array(
    'username' => 'apiForOrders',
    'password' => 'SWLsH4rQcKp6obcnUByDeEDQ30VrKeIwPvNyWhjqTJhQEDnQHNXTNZcpe6MDPAzNRtHbX5XhVipxGh8AhdlHtB3J5XDye7c4dJWGqYqPZqcuPGcXrYrEllvwEfDP6PbO7n4S15SIwLUkv5dvxoDtEkc4gnmJQJAYeVm5rRFRe17U7ohU6uS4FFpNv02iQA4SEekAYwI6xLDpmQHYqplHCHB61qFJCi7tru5iIRIPdFGXf138SVoUPEuzyfvzBmWN',
);

$json = do_curl_request($url, $fields);
$authData = json_decode($json);
$orderArr[] = getOrderInfo($orderExternalId);

file_put_contents('orderHistory.txt', print_r($orderArr, true), FILE_APPEND);




/*$orderExternalId_last = (int)$orderExternalId;
$orderExternalId_first = $orderExternalId_last - 20;

for ($i = $orderExternalId_first; $i <= $orderExternalId_last; $i++) {
    $orderArr[] = getOrderInfo($i);
    $orderInfo = getOrderInfo($i);
    $ordersExIds[] = $orderInfo['order']['order_id'];

    for ($count = 0; $count <= 20; $count++){
        $response = $client->request->ordersGet($ordersExIds[$count]);
        if ($response['success'] != false) {
            continue;
        } else {

        }
    }
}*/

/*$response = $client->request->ordersGet(17639);
if ($response['success'] == false){
    var_dump($response);
} else echo 'net';*/


//file_put_contents('ordersFromAdmin.txt', print_r($orderArr, true), FILE_APPEND);
//file_put_contents('ordersExIds.txt', print_r($ordersExIds, true), FILE_APPEND);

