<?php
namespace php\util;

use PDO;
use PDOException;
use php\Logger;

/**
 * 
 * @author dsu
 *
 */
class DBUtil
{
    private static $connection = null;
    
    public static function connect( $database, $user, $password )
    {
        try
        {
            self::$connection = new PDO( "mysql:charset=utf8;host=localhost;dbname=". $database, $user, $password );
            self::$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } 
        catch ( PDOException $e ) 
        {
            Logger::log( "Error occured while trying to connect to database: " . $e->getMessage() );
            die();
        }
    }
    
    public static function getConnection ()
    {
        return self::$connection;
    }
}
