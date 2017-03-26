<?php

/**
 * Created by PhpStorm.
 * User: geoffpopple
 * Date: 26/3/17
 * Time: 9:48 PM
 */

class Database
{
    private static $dbName = 'ifly' ;
    private static $dbHost = '127.0.0.1' ;
    private static $dbUsername = 'root';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection through whole application
        if ( null == self::$cont )
        {
            try
            {
                if (!empty(self::$dbUsername)) {
                    self::$cont =  new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,
                        self::$dbUsername);
                    self::$cont ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                    self::$cont ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>