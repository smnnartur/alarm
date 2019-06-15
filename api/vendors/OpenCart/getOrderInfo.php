<?php

function getOrderInfo($order_id) {

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"https://shopbarn.ru/index.php?route=api/order/info&order_id=$order_id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'apicookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'apicookie.txt');

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

$result = json_decode($result);
$arr = json_decode(json_encode($result), true);

return $arr;
}
