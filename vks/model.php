<?php
include_once __DIR__ . '/DB.php';

class vksModel
{

    public static function index ()
    {
        $DB = new DB();
        $query = $DB->connect ();
        $select = $query->query ( 'SELECT * FROM vks' );
        return $select;
    }
    public static function school(){
        $DB = new DB();
        $query = $DB->connect ();
        $select = $query->query ( 'SELECT school FROM vks GROUP BY school' );
        return $select;
    }
}
