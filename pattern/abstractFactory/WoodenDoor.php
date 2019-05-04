<?php
require_once 'Door.php';

use abstractFactory\Door as Door;

/**
 * Class WoodenDoor
 */
class WoodenDoor implements Door
{


    /**
     * @return mixed
     */
    public function getDescription ()
    {
        echo 'Wooden Door';
    }
}