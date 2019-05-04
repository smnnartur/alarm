<?php

require_once 'HiringManager.php';
require_once 'Developer.php';
class DevelopmentManager extends HiringManager {

    /**
     * @return Interviewer
     */
    public function makeInterViewer (): Interviewer
    {
        return new Developer();
    }
}