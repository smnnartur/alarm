<?php

require "common.php";

// set up params
$url = 'http://snaryaga.org/index.php?route=api/login';

$fields = array (
//    'username' => 'demo_api_user' ,
    'key' => 'ammFe2pCVti8FoL8tYFeLhZkkRPRoHhQ6vW5algsVuf3zfRF2kmQZ6VeJxCGzBJyCPfpqqpVgfssFA6GI6Bx88pzyKVZIKwtsJfMG4gQDscTqD4Lvg5sTFOVxZrNsnD6srdlq0YafJ63JA5jumo2mahcBgQGfV7Gm0jwgkprgTbFktPzGMZyGCo2V3EbOQjj3o05QU3ZM2p2U18xtbckV5aQCxvIbmLE37xIBCDQH4EDzmoEjhWiySi8QH3ITjDt' ,
);

//$data_json=file_get_contents ('target.json');
$ch = curl_init ();

curl_setopt ( $ch , CURLOPT_URL , $urlapi );
curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' ) );
curl_setopt ( $ch , CURLOPT_POST, 1);
curl_setopt ( $ch , CURLOPT_POSTFIELDS , $fields['key'] );

$response = curl_exec ( $ch );
curl_close ( $ch );
var_dump ($response);