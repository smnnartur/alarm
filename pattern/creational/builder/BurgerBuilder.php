<?php
require_once 'Burger.php';

/**
 * Class BurgerBuilder
 */
class BurgerBuilder
{
    /**
     * @var
     */
    public $size;
    /**
     * @var bool
     */
    public $cheeze = false;
    /**
     * @var bool
     */
    public $peperoni = false;
    /**
     * @var bool
     */
    public $tomato = false;

    /**
     * BurgerBuilder constructor.
     * @param $size
     */
    public function __construct ( $size )
    {
        $this->size = $size;
    }

    /**
     * @return $this
     */
    public function addCheeze ()
    {
        $this->cheeze = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function addPeperoni ()
    {
        $this->peperoni = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function addTomato ()
    {
        $this->tomato = true;
        return $this;
    }

    /**
     * @return Burger
     */
    public function build ()
    {
        return new Burger( $this );
    }

}