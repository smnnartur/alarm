<?php

//5.6
interface Logger
{
    public function log ( $msg );
}

class TerminalLogger implements Logger
{
    public function log ( $msg )
    {
        var_dump ( $msg );
    }
}

class Application
{
    protected $logger;

    public function setLogger ( Logger $logger )
    {
        $this->logger = $logger;
        return $this;
    }

    public function action ()
    {
        $this->logger->log ( 'heeeey' );
    }
}

$app = new Application();
$app->setLogger ( new Class implements Logger
{
    public function log ( $msg )
    {
        var_dump ( $msg );
    }
} );
$app->action ();


//7+
