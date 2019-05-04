<?php
require_once 'DoorFactory.php';
require_once 'Welder.php';
require_once 'WoodenDoor.php';

use abstractFactory\DoorFactory as Doorfactory;

/**
 * Class WoodenDoorFactory
 */
class WoodenDoorFactory implements DoorFactory
{

    /**
     * @return mixed
     */
    public function makeDoor ()
    {
        return new WoodenDoor();
    }

    /**
     * @return mixed
     */
    public function makeFittingexpert ()
    {
        return new Welder();
    }
}