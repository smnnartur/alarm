<?php
require_once 'Lion.php';
/**
 * Class AsianLion
 */
class AsianLion implements Lion
{

    /**
     * @return mixed
     */
    public function roar ()
    {
        echo 'Asian Lion Roar';
        return $this;
    }
}