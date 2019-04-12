<?php

try {
    $DB = new PDO( 'mysql:host=localhost;dbname=json' , 'artur' , 'alfa12345' );
}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}