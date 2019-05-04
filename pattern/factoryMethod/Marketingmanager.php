<?php
require_once 'HiringManager.php';
require_once 'CommunityExecutive.php';

/**
 * Class Marketingmanager
 */
class Marketingmanager extends HiringManager
{

    /**
     * @return Interviewer
     */
    public function makeInterViewer (): Interviewer
    {
        return new CommunityExecutive();
    }
}