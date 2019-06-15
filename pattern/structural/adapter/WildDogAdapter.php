<?php
require_once 'Lion.php';
require_once 'WildDog.php';

/**
 * Class WildDogAdapter
 */
class WildDogAdapter implements Lion
{
    /**
     * @var WildDog
     */
    protected $dog;

    /**
     * WildDogAdapter constructor.
     * @param $dog
     */
    public function __construct ( WildDog $dog )
    {
        $this->dog = $dog;
    }

    /**
     * @return mixed
     */
    public function roar ()
    {
        $this->dog->bark ();
    }
}
