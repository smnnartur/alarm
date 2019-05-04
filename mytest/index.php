<?php

ini_set ( 'display_errors' , 1 );

$urlapi = 'https://online.moysklad.ru/api/remap/1.1/entity/customerorder';
$username = 'admin@smnnartur1';
$password = '1e29db9dbbe0';

function pre ( $var )
{
    echo '<pre>';
    var_dump ( $var );
    echo '</pre>';
}


$data_json=file_get_contents ('target.json');
$ch = curl_init ();

curl_setopt ( $ch , CURLOPT_URL , $urlapi );
curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' ) );
curl_setopt ( $ch , CURLOPT_POST, 1);
curl_setopt ( $ch , CURLOPT_POSTFIELDS , $data_json );

$response = curl_exec ( $ch );
curl_close ( $ch );