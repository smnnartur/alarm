<?php
require_once 'DoorFittingExpert.php';

use abstractFactory\DoorFittingExpert as DoorFittingExpert;

/**
 * Class Welder
 */
class Welder implements DoorFittingExpert
{

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        echo 'Wooden Door Expert';
    }
}