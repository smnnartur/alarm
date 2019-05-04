<?php
require_once 'DoorFactory.php';
require_once 'Carpenter.php';
require_once 'IronDoor.php';

use abstractFactory\DoorFactory as DoorFactory;

/**
 * Class IronDoorFactory
 */
class IronDoorFactory implements DoorFactory
{

    /**
     * @return mixed
     */
    public function makeDoor ()
    {
        return new IronDoor();
    }

    /**
     * @return mixed
     */
    public function makeFittingexpert ()
    {
        return new Carpenter();
    }
}