<?php

require_once 'WoodenDoor.php';

ini_set ( 'display_errors' , 1 );

/**
 * Class DoorFactory
 */
class DoorFactory
{
    /**
     * @param $width
     * @param $height
     * @return Door
     */
    public static function makeDoor ( $width , $height ): Door
    {
        return new WoodenDoor( $width , $height );
    }
}

//How To Use
$door = new DoorFactory();
$getParams = $door->makeDoor ( 100 , 200 );
echo $getParams->getWidth ();
echo $getParams->getHeight ();