<?php
    class Database {

        // The database connection
        protected static $connection;

        /**
        * Connect to the database
        *
        * @return null on failure / PDO object instance on success
        */

        public static function connect() {
        // Try and connect to the database
            // Emulate a singleton in PHP
        if(!isset(self::$connection)) {
            $config = parse_ini_file('Config.ini');
            self::$connection = new PDO( "mysql:host=127.0.0.1;dbname=".$config['dbname'], $config['username'],$config{'password'});
            //prevent prepared statement emmulation
            //avoid SQL Injection
            self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // If connection was not successful, handle the error
         if(self::$connection === false) {
            // To be don: Handle error - log to a file, show an error etc.
        return null;
        }

        return self::$connection;
}

        public static function disconnect()
        {
            self::$connection = null;
        }
}