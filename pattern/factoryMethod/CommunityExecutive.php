<?php
require_once 'Interviewer.php';
/**
 * Class communityExecutive
 */
class CommunityExecutive implements Interviewer
{

    /**
     * @return mixed
     */
    public static function askQuestion ()
    {
        echo 'someting abot marketing Question';
    }
}