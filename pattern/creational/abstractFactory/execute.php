<?php
ini_set ( 'display_errors' , 1 );
require_once 'WoodenDoorFactory.php';
require_once 'IronDoorFactory.php';

$woodenFactory = new WoodenDoorFactory();
$door = $woodenFactory->makeDoor ();
$expert = $woodenFactory->makeFittingexpert ();
$door->getDescription ();
echo "<br>";
$expert->getDescription ();

echo "<br>";

$ironFactory = new IronDoorFactory();
$door = $ironFactory->makeDoor ();
$expert = $ironFactory->makeFittingexpert ();
$door->getDescription ();
echo "<br>";
$expert->getDescription ();