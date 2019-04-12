<?php
class DB{
    private $username = "artur";
    private $password = "alfa12345";

    /**
     * DB constructor.
     */
    public function connect ()
    {
        try {
            $DB = new PDO( 'mysql:host=localhost;dbname=vks' , 'artur' , 'alfa12345' );
            $DB->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage ();
        }
        return $DB;

    }

}
