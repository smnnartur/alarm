<?php
require_once 'Door.php';
ini_set ( 'display_errors' , 1 );

/**
 * Class WoodenDoor
 */
class WoodenDoor implements Door
{
    /**
     * @var float
     */
    protected $width;
    /**
     * @var float
     */
    protected $height;

    /**
     * WoodenDoor constructor.
     * @param float $width
     * @param float $height
     */
    public function __construct ( float $width , float $height )
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getWidth (): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight (): float
    {
        return $this->height;
    }
}

$new = new WoodenDoor( 100 , 200 );
//echo $new->getHeight ();