<?php

$host = '127.0.0.1';
$db = 'ajax';
$user = 'artur';
$pass = 'alfa12345';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ,
    PDO::ATTR_EMULATE_PREPARES => false ,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO( $dsn , $user , $pass , $options );
} catch (\PDOException $e) {
    throw new \PDOException( $e->getMessage () , (int)$e->getCode () );
}
$queryFirst = $pdo->query ( 'SELECT * FROM first' )->fetchAll ();
$querySecond = $pdo->query ( 'SELECT * FROM second' )->fetchAll ();
$queryThird = $pdo->query ( 'SELECT * FROM third' )->fetchAll ();

//$data = $pdo->query ( "SELECT * FROM third" )->fetchAll ();
// and somewhere later:
if($_GET['value']=='1'){
    $query=$queryFirst;
}elseif ($_GET['value']=='2'){
    $query=$querySecond;
}elseif ($_GET['value']=='3'){
    $query=$queryThird;
}
foreach ( $query as $row ) {
    print_r  ($row[ 'id' ]);
    print_r ($row[ 'name' ]);

}