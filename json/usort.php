<?php
$filedir=__DIR__.'/json.json';

$jsonDecode=json_decode (file_get_contents ($filedir),true);

function rocket($first,$second){
    return $first['name']<=>$second['name'];
}
usort ($jsonDecode['employee'],'rocket');

foreach ($jsonDecode['employee'] as $item){
    $item[]=$jsonDecode['employee'];
}
$file = fopen ( 'usort_json.json' , 'w+' );
fwrite ( $file , json_encode ( $jsonDecode ,JSON_PRETTY_PRINT) );
fclose ( $file );
print '<pre>';
print_r ( $jsonDecode );
print '</pre>';