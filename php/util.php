<?php

/***************************************************************************************************************
 *
 *  This file contains all util classes
 *
 ***************************************************************************************************************/

/**
 * 
 * @author dsu
 *
 */
class DBUtil
{
    private static $connection = null;

    public static function connect ( $database, $user, $password )
    {
        try
        {
            self::$connection = new PDO( "mysql:charset=utf8;host=localhost;dbname=" . $database, $user, $password );
            self::$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch ( PDOException $e )
        {
            $msg = "Error occured while trying to connect to database";
            Logger::log( $msg . ": " . $e->getMessage() );
            
            Renderer::default( "Error", "error/500.htm.php", [
                "msg" => $msg
            ] );
            die();
        }
    }

    public static function getConnection ()
    {
        return self::$connection;
    }
}

/**
 * 
 * @author dsu
 *
 */
class QueryUtil
{

    public static function execute ( $sql )
    {
        try
        {
            $conn = DBUtil::getConnection();
            
            if ( $conn != null )
            {
                $prepared = $conn->prepare( $sql );
                return $prepared->execute();
            }
            else
            {
                Logger::error( "No connection available while trying to execute query: '" . $sql . "'" );
            }
        }
        catch ( PDOException $e )
        {
            Logger::error( "Error occured while executing query: '" . $sql . "'" );
        }
    }

    public static function query ( $query ): array
    {
        try
        {
            $conn = DBUtil::getConnection();
            
            if ( $conn != null )
            {
                $returnValue = $conn->query( $query );
                return $returnValue->fetchAll( PDO::FETCH_OBJ );
            }
            else
            {
                Logger::error( "No connection available while trying to execute query: '" . $query . "'" );
            }
        }
        catch ( PDOException $e )
        {
            Logger::error( "Error occured while executing query: '" . $query . "'" );
        }
        
        return [];
    }
}

/**
 * 
 * @author dsu
 *
 */
class NavUtil
{

    public static function isActive ( $link )
    {
        echo $_SERVER[ "REQUEST_URI" ] == $link ? "active" : "";
    }
}

/**
 * 
 * @author dsu
 *
 */
class FileUtil 
{
    public static function exists ( $file )
    {
        if ( isset( $file ) )
        {
            return file_exists( $file ) && !is_dir( $file ) ? true : false;
        }
        return false;
    }
}