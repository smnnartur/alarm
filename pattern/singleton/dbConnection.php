<?php

final class dbConnection
{
    private static $instance;

    /**
     * @return mixed
     */
    public static function getInstance ()
    {
        if ( !self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct ()
    {
        echo 'DB CONNECTION';
    }

    private function __wakeup ()
    {
        // TODO: Implement __wakeup() method.
    }

    private function __clone ()
    {
        // TODO: Implement __clone() method.
    }

}

dbConnection::getInstance ();
dbConnection::getInstance ();