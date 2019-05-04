<?php
require_once 'BurgerBuilder.php';

/**
 * Class Burger
 */
class Burger
{
    /**
     * @var
     */
    protected $size;

    /**
     * @var bool
     */
    protected $cheese = false;
    /**
     * @var bool
     */
    protected $pepperoni = false;
    /**
     * @var bool
     */
    protected $tomato = false;

    /**
     * Burger constructor.
     * @param BurgerBuilder $builder
     */
    public function __construct ( BurgerBuilder $builder )
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheeze;
        $this->pepperoni = $builder->peperoni;
        $this->tomato = $builder->tomato;
    }
}