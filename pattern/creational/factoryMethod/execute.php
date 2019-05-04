<?php
require_once 'DevelopmentManager.php';
require_once 'Marketingmanager.php';
ini_set ( 'display_errors' , 1 );

$developermanager = new DevelopmentManager();
$developermanager->takeInterView ();
echo "<br>";
$marketingmanager = new Marketingmanager();
$marketingmanager->takeInterView ();