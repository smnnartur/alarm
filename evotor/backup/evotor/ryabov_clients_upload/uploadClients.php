<?php
header('Content-Type: text/html; charset=utf-8');
require_once ( "vendor/autoload.php" );
$urlRetail ="https://flossyshoes.retailcrm.ru";
$apiKey = "flaU5ZvRPAk7pMhUQvib7CLsO2kHClRW";

$retail = new \RetailCrm\ApiClient(
    $urlRetail,
    $apiKey,
    \RetailCrm\ApiClient::V5
);
//$ch = curl_init ();
//
//curl_setopt ( $ch , CURLOPT_URL , $urlapi );
//curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
//curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' ) );
////curl_setopt ( $ch , CURLOPT_POST , 1 );
////curl_setopt ( $ch , CURLOPT_POSTFIELDS , $data_json );
//
//$response = curl_exec ( $ch );
//curl_close ( $ch );

echo "<pre>";
var_dump ($retail->request->customersList ());
echo "</pre>";