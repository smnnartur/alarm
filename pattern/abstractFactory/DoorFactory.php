<?php

namespace abstractFactory;

/**
 * Interface DoorFactory
 * @package abstractFactory
 */
interface DoorFactory
{
    /**
     * @return mixed
     */
    public function makeDoor ();

    /**
     * @return mixed
     */
    public function makeFittingexpert ();
}