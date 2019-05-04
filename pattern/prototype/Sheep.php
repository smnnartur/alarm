<?php

/**
 * Class Sheep
 */
class Sheep
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $category;

    /**
     * Sheep constructor.
     * @param $name
     * @param $category
     */
    public function __construct ( $name , $category )
    {
        $this->name = $name;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName ( $name ): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory ()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory ( $category ): void
    {
        $this->category = $category;
    }

}

$sheep = new Sheep( 'Jolly' , 'White' );
echo $sheep->getName (); //Jolly
echo $sheep->getCategory (); //White

$cloned = clone $sheep;
$cloned->setName ( 'Dolly' );
echo $cloned->getName (); //Dolly
echo $cloned->getCategory (); //White