<?php
header ( 'Content-Type: text/html; charset=utf-8' );
require_once ( "vendor/autoload.php" );
$urlRetail = "https://flossyshoes.retailcrm.ru";
$apiKey = "flaU5ZvRPAk7pMhUQvib7CLsO2kHClRW";
//
$retail = new \RetailCrm\ApiClient(
    $urlRetail ,
    $apiKey ,
    \RetailCrm\ApiClient::V5
);
$customers = [];
$customer[ "lastName" ] = (string) "test lastName";
$customer[ "firstName" ] = (string) "test firstname";
$customer[ "patronymic" ] = (string) "";
$customer[ "sex" ] = (string) "Ж";
$customer[ "email" ] = (string) "test@test.com";
$customer[ "phones" ][][ "number" ] = (string) "+7(987)777-77-77";
$customer[ "birthday" ] = strtotime ( "" );
$customer[ "discountCardNumber" ] = (string) "";
$customer[ "personalDiscount" ] = (double) "";
$customer[ "customFields" ][ "Размер Flossy" ] = (string) "";
$customer[ "customFields" ][ "Комментарий" ] = (string) "comment";
$customer[ "address" ][ "city" ] = (string) "Казань";
$customer[ "address" ][ "region" ] = (string) "Республика Татарстан";
$customer[ "address" ][ "countryIso" ] = (string) "Страна";
$customer[ "address" ][ "index" ] = (string) "123";
$customer[ "address" ][ "metro" ] = (string) "Аннино";
$customer[ "address" ][ "street" ] = (string) "улица";
$customer[ "address" ][ "building" ] = (string) "здание";
$customer[ "address" ][ "house" ] = (string) "строение";
$customer[ "address" ][ "flat" ] = (string) "2";
$customer[ "address" ][ "floor" ] = (integer) 2;
$customer[ "address" ][ "block" ] = (integer) 1;
$customers[] = $customer;

//    $retail->request->customersUpload ($customers);


$file = '0075168001556453310_0.csv';
$csv = array_map ( 'str_getcsv' , file ( $file ) );
array_walk ( $csv , function ( &$a ) use ( $csv ) {
    $a = array_combine ( $csv[ 0 ] , $a );
} );
array_shift ( $csv );

//$customers = [];
//foreach ( $csv as $item ) {
//    $customer[ "lastName" ] = (string) $item[ 'Фамилия' ];
//    $customer[ "firstName" ] = (string) $item[ 'Имя' ];
//    $customer[ "patronymic" ] = (string) $item[ 'Отчество' ];
//    $customer[ "sex" ] = (string) $item[ 'Пол' ];
//    $customer[ "email" ] = (string) $item[ 'E-Mail' ];
//    $customer[ "phones" ][ 0 ][ "number" ] = (string) $item[ "Номер телефона (в международном формате +7(***)***-**-**" ];
//    $customer[ "birthday" ] = strtotime ( $item[ 'День Рождения' ] ) == false ? strtotime ( $item[ 'День Рождения' ] ) : null;
//    $customer[ "discountCardNumber" ] = (string) $item[ 'Карта постоянного клинета' ];
//    $customer[ "personalDiscount" ] = (double) $item[ 'Процент персонально скидки' ];
////    $customer[ "customFields" ][ "Размер Flossy" ] = (string) $item[ 'Размер Flossy' ];
////    $customer[ "customFields" ][ "Комментарий" ] = (string) $item[ 'Комментарий' ];
//    $customer[ "address" ][ "city" ] = (string) $item[ 'Город' ];
//    $customer[ "address" ][ "region" ] = (string) $item[ 'Регион' ];
//    $customer[ "address" ][ "countryIso" ] = (string) $item[ 'Страна' ];
//    $customer[ "address" ][ "index" ] = (string) $item[ 'Почтовый индекс' ];
//    $customer[ "address" ][ "metro" ] = (string) $item[ 'Метро' ];
//    $customer[ "address" ][ "street" ] = (string) $item[ 'Улица' ];
//    $customer[ "address" ][ "building" ] = (string) $item[ 'Дом' ];
//    $customer[ "address" ][ "house" ] = (string) $item[ "Строение/Корпус" ];
//    $customer[ "address" ][ "flat" ] = (string) $item[ 'Квартира' ];
//    $customer[ "address" ][ "floor" ] = (string) $item[ 'Этаж' ];
//    $customer[ "address" ][ "block" ] = (string) $item[ 'Подъезд' ];
//    $customers[] = $customer;
//
//}

echo "<pre>";
var_dump ( $customers );
echo "</pre>";