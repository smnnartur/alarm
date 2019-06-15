<?php
set_time_limit ( 0 );
header ( 'Content-Type: text/html; charset=utf-8' );

require_once ( "insalesApi.php" );
require "vendor/autoload.php";

$urlRetail = "https://flossyshoes.retailcrm.ru";
$apiKey = "flaU5ZvRPAk7pMhUQvib7CLsO2kHClRW";
$data = $_GET;

file_put_contents ( 'request_id.log' , $data );

$id = file_get_contents ( 'request_id.log' );
$retail = new \RetailCrm\ApiClient(
    $urlRetail ,
    $apiKey ,
    \RetailCrm\ApiClient::V5
);
$insales = new\retail\insalesApi( 'a641b9ec9b15868ee3206a667cab1321' , '06314e0ebaac09a6fd78b1985e16a0d8' );

$urlapi = "https://flossyshoes.retailcrm.ru/api/v5/orders/$id?apiKey=flaU5ZvRPAk7pMhUQvib7CLsO2kHClRW";
$username = 'superviser@dmitriy12';
$password = 'F1o55yi9';
$ch = curl_init ();
$curl_options = [
    CURLOPT_URL => $urlapi ,
    CURLOPT_RETURNTRANSFER => true ,
    CURLOPT_USERPWD => "$username:$password" ,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC ,
    CURLOPT_HTTPHEADER => array ( 'Content-Type: application/json' ) ,
];


curl_setopt_array ( $ch , $curl_options );
$output = curl_exec ( $ch );
curl_close ( $ch );

$order = json_decode ( $output , true )[ 'order' ];
$order_changes = [];
$order_changes[ 'status' ] = $order[ 'status' ];
$order_changes[ 'payment_status' ] = reset ( $order[ 'payments' ] )[ 'status' ];
$order_changes[ 'total_sum' ] = $order[ "totalSumm" ];

$out = $insales->getOrder ( $id );


$insales_change = [];
$out[ 'fulfillment-status' ] = $order[ 'status' ];
$out[ "financial-status" ] = reset ( $order[ 'payments' ] )[ 'status' ];
$out[ "order-lines" ][ "order-line" ][ "full-total-price" ] = sprintf ( "%.1f" , $order[ "totalSumm" ] );


function changePayStatus ( $namePayStatus )
{
    $xml = '';
    $xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<order>';
    $xml .= '<financial-status>' . $namePayStatus . '</financial-status>';
    $xml .= '</order>';
    return $xml;
}

function changeStatus ( $nameStatus )
{
    $xml = '';
    $xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<order>';
    $xml .= '<fulfillment-status>' . $nameStatus . '</fulfillment-status>';
    $xml .= '</order>';
    return $xml;
}


function changeSum ( $id , $price , $quantity )
{
    $xml = '';
    $xml .= '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<order>';
    $xml .= '<order-lines-attributes type="array">';
    $xml .= '<order-lines-attribute>';
    $xml .= '<id type="integer">' . $id . '</id>';
    $xml .= '<sale-price type="integer">' . $price . '</sale-price>';
    $xml .= '<quantity type="integer">' . $quantity . '</quantity>';
    $xml .= '</order-lines-attribute>';
    $xml .= '</order-lines-attributes>';
    $xml .= '</order>';

    return $xml;
}

//Изменение Статуса Оплаты
$insales->changeOrder ( $id , changePayStatus ( reset ( $order[ 'payments' ] )[ 'status' ] ) );
//Изменение Статуса
$insales_status = [ 'new' => 'new'
    , 'availability-confirmed' => 'approved'
    , 'send-to-delivery' => 'approved'
    , 'prepayed' => 'komplektuetsya'
    , 'assembling' => 'approved'
    , 'redirect' => 'dispatched'
    , 'complete' => 'delivered'
    , 'cancel-other' => 'declined'
    , 'return' => 'returned'
];
$req = $insales->changeOrder ( $id , changeStatus ( $insales_status[ $order[ 'status' ] ] ) );


//Изменение Суммы
foreach ( $out[ "order-lines" ][ "order-line" ] as $key => $out_item ) {
    $out_id[ $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] ] = $out[ "order-lines" ][ "order-line" ][ $key ][ "id" ];

    foreach ( $order[ 'items' ] as $value ) {
        if ( $value[ 'offer' ][ "externalId" ] == $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] ) {
            $req = $insales->changeOrder ( $id ,
                changeSum ( $out_id[ $value[ 'offer' ][ "externalId" ] ] , $value[ "initialPrice" ] , $value[ "quantity" ] )
            );
//            file_put_contents ( 'test2.log' , [ $req , $value[ 'offer' ][ "externalId" ] ] , FILE_APPEND );
        }
    }
    if ( !is_numeric ( $key ) ) {
        $out_id[ $out[ "order-lines" ][ "order-line" ][ "variant-id" ] ] = $out[ "order-lines" ][ "order-line" ][ "id" ];

        foreach ( $order[ 'items' ] as $value ) {
            if ( $value[ 'offer' ][ "externalId" ] == $out[ "order-lines" ][ "order-line" ][ "variant-id" ] ) {
                $req = $insales->changeOrder ( $id ,
                    changeSum ( $out_id[ $value[ 'offer' ][ "externalId" ] ] , $value[ "initialPrice" ] , $value[ "quantity" ] )
                );
//                file_put_contents ( 'test2.log' , [ $req , $value[ 'offer' ][ "externalId" ] ] , FILE_APPEND );
            }
        }
    }
}

//Создание товара
function create ( $id , $externalId , $quantity )
{
    //externalId
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<order>';
    $xml .= '<order-lines-attributes type="array">';
    $xml .= '<order-lines-attribute>';
    $xml .= '<variant-id type="integer">' . $externalId . '</variant-id>';
    $xml .= '<quantity type="integer">' . $quantity . '</quantity>'; //!!!!!!!!!!!!!!TUT
    $xml .= '</order-lines-attribute>';
    $xml .= '</order-lines-attributes>';
    $xml .= '</order>';

    //поменять 20553929 на $id
    $urlapi = "http://myshop-kj459.myinsales.ru/admin/orders/$id.xml";
    $username = 'a641b9ec9b15868ee3206a667cab1321';
    $password = '06314e0ebaac09a6fd78b1985e16a0d8';
    $ch = curl_init ();
    $curl_options = [
        CURLOPT_URL => $urlapi ,
        CURLOPT_RETURNTRANSFER => true ,
        CURLOPT_USERPWD => "$username:$password" ,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC ,
        CURLOPT_HTTPHEADER => array ( 'Content-Type: application/xml' ) ,
        CURLOPT_CUSTOMREQUEST => 'PUT' ,
        CURLOPT_POSTFIELDS => $xml
    ];


    curl_setopt_array ( $ch , $curl_options );
    $insale_output = curl_exec ( $ch );
    curl_close ( $ch );
}

$ms_item_arr = [];
foreach ( $order[ 'items' ] as $value ) {

    $ms_item_arr[] = $value[ 'offer' ][ "externalId" ];
}


$insale_order_arr = [];
foreach ( $out[ "order-lines" ][ 'order-line' ] as $key => $out_item ) {
    for ( $i = 0; $i < count ( $out[ "order-lines" ][ 'order-line' ] ); $i++ ) {
        $insale_order_arr[ $out[ "order-lines" ][ 'order-line' ][ $i ][ "variant-id" ] ] = $out[ "order-lines" ][ 'order-line' ][ $i ][ "variant-id" ];
        $insale_order_arr1[ $out[ "order-lines" ][ 'order-line' ][ $i ][ "id" ] ] = $out[ "order-lines" ][ 'order-line' ][ $i ][ "variant-id" ];
    }
    if ( strlen ( strval ( $out[ "order-lines" ][ "order-line" ][ "variant-id" ] ) ) == 9 ) {
        $insale_order_arr[ $out[ "order-lines" ][ "order-line" ][ "variant-id" ] ] = $out[ "order-lines" ][ "order-line" ][ "variant-id" ];
        $insale_order_arr1[ $out[ "order-lines" ][ "order-line" ][ "id" ] ] = $out[ "order-lines" ][ "order-line" ][ "variant-id" ];
    }
}
//file_put_contents ( 'test_create.log' , [ 1 , print_r ( $insale_order_arr , 1 ) ] , FILE_APPEND );
//file_put_contents ( 'test_create.log' , [ 2 , print_r ( $ms_item_arr , 1 ) ] , FILE_APPEND );

$result = [];
foreach ( $ms_item_arr as $value ) {
    if ( !in_array ( $value , $insale_order_arr ) ) {
        $arr[ $value ] = $value;
        $result = array_unique ( $arr );
    }
}

foreach ( $insale_order_arr1 as $key => $value ) {
    if ( !in_array ( $value , $ms_item_arr ) ) {
        $arr1[ $key ] = $key;
        $result1 = array_unique ( $arr1 );
    }
}

//file_put_contents ( 'test_create.log' , [ 3 , print_r ( $result , 1 ) ] , FILE_APPEND );

/////!!!!!!!!!!!!!!!!!!!!TUT
//if ($id == "20553929") {
foreach ( $result as $key => $externalId ) {
    foreach ( $order[ 'items' ] as $value ) {
        if ( $externalId == $value[ 'offer' ][ "externalId" ] ) {
            $quantity = (int) $value[ "quantity" ];
            break;
        }
    }
    create ( $id , $externalId , $quantity );

}
foreach ( $result1 as $key => $orderLineId ) {
    delete ( $id , $orderLineId );
}
//}

file_put_contents ( 'test3.log' , print_r ( $order , 1 ) , FILE_APPEND );

//file_put_contents ( 'test2.log' , print_r ( $out , 1 ) , FILE_APPEND );

//Удаление Товара
function delete ( $id , $orderLineId )
{
    //externalId
    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<order>';
    $xml .= '<order-lines-attributes type="array">';
    $xml .= '<order-lines-attribute>';
    $xml .= '<id type="integer">' . $orderLineId . '</id>';
    $xml .= '<_destroy type="boolean">true</_destroy>';
    $xml .= '</order-lines-attribute>';
    $xml .= '</order-lines-attributes>';
    $xml .= '</order>';

    //id
    $urlapi = "http://myshop-kj459.myinsales.ru/admin/orders/$id.xml";
    $username = 'a641b9ec9b15868ee3206a667cab1321';
    $password = '06314e0ebaac09a6fd78b1985e16a0d8';
    $ch = curl_init ();
    $curl_options = [
        CURLOPT_URL => $urlapi ,
        CURLOPT_RETURNTRANSFER => true ,
        CURLOPT_USERPWD => "$username:$password" ,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC ,
        CURLOPT_HTTPHEADER => array ( 'Content-Type: application/xml' ) ,
        CURLOPT_CUSTOMREQUEST => 'PUT' ,
        CURLOPT_POSTFIELDS => $xml
    ];
    curl_setopt_array ( $ch , $curl_options );
    $insale_output = curl_exec ( $ch );
    curl_close ( $ch );
    file_put_contents ( 'test_del_response.log' , $insale_output , FILE_APPEND );

    return ( $insale_output );
}


//$order_del_arr = [];
//foreach ( $order[ 'items' ] as $value ) {
//    $order_del_arr[] = $value;
//}
//foreach ( $out[ "order-lines" ][ "order-line" ] as $key => $out_item ) {
//    file_put_contents ( 'test_del_2.log' , print_r ( $order_del_arr , 1 ) , FILE_APPEND );
//    file_put_contents ( 'test_del.log' , '/-' . $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] , FILE_APPEND );
//    if ( !in_array ( $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] , $order_del_arr ) ) {
//        delete (  $out[ "order-lines" ][ "order-line" ][ $key ]['id'] , $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ]);
//    }
//}


//    foreach ( $order[ 'items' ] as $value ) {
//        file_put_contents ( 'test_del.log' , '/1-' . $value[ 'offer' ][ "externalId" ] , FILE_APPEND );
//        file_put_contents ( 'test_del.log' , '/2-' . $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] , FILE_APPEND );
//
//        if ( $value[ 'offer' ][ "externalId" ] != $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] ) {
//            file_put_contents ( 'test_del.log' , '/'.$out_id[ $out[ "order-lines" ][ "order-line" ][ $key ][ "variant-id" ] ] , FILE_APPEND );
//        }
//    }