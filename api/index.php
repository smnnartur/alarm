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


//---------------------------------------------------------------------------------------------------------------------------------------------
////Вывод значения поля 'Комментарий' в заказе покупателя
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $urlapi);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//$output = curl_exec($ch);
//$info = curl_getinfo($ch);
//curl_close($ch);
//$decode=json_decode ($output,true);
//foreach ($decode['rows'] as $value){
//    echo $value['description'] ?? null;
//}


//---------------------------------------------------------------------------------------------------------------------------------------------
////Вывод списка позиций в заазе покупателя
//$arr=[];
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $urlapi);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//$output = curl_exec($ch);
//$info = curl_getinfo($ch);
//curl_close($ch);
//$decode=json_decode ($output,true);
//foreach ($decode['rows'] as $key=>$value){
//    foreach ($value['positions']['meta'] as $position_key=>$position){
//       $arr[]=$position;
//    }
//}
//foreach ($arr as $item){
//    echo $item."<br>" ?? null;
//}

//---------------------------------------------------------------------------------------------------------------------------------------------
////Изменяем значение поле 'Комментарий' в заказе покупателя (PUT)
//$data = array ( "description" => 'Nice' );
//$data_json = json_encode ( $data );
//$ch = curl_init ();
//
//curl_setopt ( $ch , CURLOPT_URL , $urlapi );
//curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' , 'Content-Length: ' . strlen ( $data_json ) ) );
//curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
//curl_setopt ( $ch , CURLOPT_CUSTOMREQUEST , 'PUT' );
//curl_setopt ( $ch , CURLOPT_POSTFIELDS , $data_json );
//
//$response = curl_exec ( $ch );
//curl_close($ch);


//---------------------------------------------------------------------------------------------------------------------------------------------
////Удаление (DELETE)
//$ch = curl_init ();
//
//curl_setopt ( $ch , CURLOPT_URL , $urlapi );
//curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//curl_setopt ( $ch , CURLOPT_HTTPHEADER , [ 'Content-Type: application/json' ] );
//curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
//curl_setopt ( $ch , CURLOPT_CUSTOMREQUEST , 'DELETE' );
//
//$response = curl_exec ( $ch );
//pre ( $response );
//curl_close ( $ch );


//---------------------------------------------------------------------------------------------------------------------------------------------
////Добавление (POST) ПРИМЕЧАНИЕ:в json файл agent и organization взяты с "мойсклад" , т.к. у каждого аккаунта свои данные!
//$data_json=file_get_contents ('target.json');
//$ch = curl_init ();
//
//curl_setopt ( $ch , CURLOPT_URL , $urlapi );
//curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , true );
//curl_setopt ( $ch , CURLOPT_USERPWD , "$username:$password" );
//curl_setopt ( $ch , CURLOPT_HTTPAUTH , CURLAUTH_BASIC );
//curl_setopt ( $ch , CURLOPT_HTTPHEADER , array ( 'Content-Type: application/json' ) );
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt ( $ch , CURLOPT_POSTFIELDS , $data_json );
//
//$response = curl_exec ( $ch );
//curl_close ( $ch );