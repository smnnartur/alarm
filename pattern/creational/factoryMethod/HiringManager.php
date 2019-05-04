<?php
require_once 'Interviewer.php';

/**
 * Class HiringManager
 */
abstract class HiringManager
{
    /**
     * @return Interviewer
     */
    public abstract function makeInterViewer (): Interviewer;

    /**
     * @return mixed
     */
    public function takeInterView ()
    {
        $question = $this->makeInterViewer ();
        return $question->askQuestion ();
    }
}

