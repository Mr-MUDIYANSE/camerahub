<?php

class Database{

    public static $connection;


    public static function setUpConnection(){

        if (!isset(Database::$connection)) {
            Database::$connection  = new mysqli("localhost","root","2001","onliner1","3306");
        }
    }

    public static function iud($q){

        
        Database::setUpConnection();    
        Database::$connection->query($q);

    }

    public static function search($q){

        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        // hambena result set eka me query eka pass wena thanata return karanava meken.
        return $resultset;

    }
}

?>