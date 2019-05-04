<?php
require_once 'BurgerBuilder.php';
$burger = ( new BurgerBuilder( 14 ) )
    ->addPeperoni ()
    ->addCheeze ()
    ->addTomato ()
    ->build ();

echo "<pre>";
var_dump ( $burger );
echo "</pre>";