<?php
require_once 'Interviewer.php';

/**
 * Class Developer
 */
class Developer implements Interviewer
{

    /**
     * @return mixed
     */
    public static function askQuestion ()
    {
        echo 'somethin about developer Question';
    }
}