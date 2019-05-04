<?php
require_once 'Door.php';

use abstractFactory\Door as Door;

/**
 * Class IronDoor
 */
class IronDoor implements Door
{

    /**
     * @return mixed
     */
    public function getDescription ()
    {
        echo 'Iron Door';
    }
}