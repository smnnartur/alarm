<?php
require_once 'DoorFittingExpert.php';

use abstractFactory\DoorFittingExpert as Doorfittingexpert;

/**
 * Class Carpenter
 */
class Carpenter implements Doorfittingexpert
{

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        echo 'Iron Door Expert';
    }
}