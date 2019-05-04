<?php
require_once 'Lion.php';

/**
 * Class AfricanLion
 */
class AfricanLion implements Lion
{

    /**
     * @return mixed
     */
    public function roar ()
    {
        echo 'African Lion Roar';
    }
}