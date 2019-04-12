<?php
include_once __DIR__ . '/../conn.php';
$employee = [];
$file = fopen ( 'newjson.json' , 'w+' );
$query = $DB->query ( 'SELECT * FROM json' );
foreach ( $query as $item ) {
    $employee['employee'][] = [ 'id' => $item[ 'id' ] , 'name' => $item[ 'name' ] , 'age' => $item[ 'age' ] ];
}
fwrite ( $file , json_encode ( $employee ,JSON_PRETTY_PRINT) );
fclose ( $file );
var_dump ( $employee );
?>

<a href="link.php">FILE</a>
