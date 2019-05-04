<?php
$text = '<i>test</i> something there <i>word</i>';
$words = [];
$change = preg_replace_callback_array ( [
    "#<i>(.+?)</i>#" => function ( $word ) {
        return '<strong>' . $word[ 1 ] . '</strong>';
    } ,
] , $text );
////Вариант без массива
//$change = preg_replace_callback (
//    "#<i>(.+?)</i>#" ,
//    function ( $word ) {
//        return '<strong>' . $word[ 1 ] . '</strong>';
//    } ,
//    $text );
echo $change;


$getWord = preg_replace_callback_array ( [
    "#<i>(.+?)</i>#" => function ( $word ) use ( &$words ) {
        $words[] = $word[ 1 ];
    } ,
] , $text );
echo '<pre>';
print_r ($words);
echo '</pre>';
