<?php
//берем из json файла и заливаем в базу
include_once __DIR__.'/../conn.php';

$file=__DIR__."/json.json";

$json=file_get_contents ($file);
$decode=json_decode ($json,true);
$sql="TRUNCATE TABLE json";
$query=$DB->prepare($sql);
$query->execute();

foreach ($decode['employee'] as $item){

    $sql = "INSERT INTO json VALUES (null, :name, :age)";

    $query = $DB->prepare($sql);

    $query->execute( [ ':name'=>$item['name'], ':age'=>$item['age']] );
}