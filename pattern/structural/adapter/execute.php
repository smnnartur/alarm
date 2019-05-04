<?php
require_once 'WildDog.php';
require_once 'WildDogAdapter.php';
require_once 'Hunter.php';
require_once 'AsianLion.php';
ini_set ('display_errors',1);

$wildDog = new WildDog();
$wildDogAdapter= new WildDogAdapter($wildDog);

$asianLion = new AsianLion();

$hunter = new Hunter();
//$hunter->hunt ($wildDog); //Fatal Error
$hunter->hunt ($wildDogAdapter);
