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

    private static function prepare ( $sql, $params = null )
    {
        try
        {
            $conn = DBUtil::getConnection();
            
            if ( $conn != null )
            {
                $prepared = $conn->prepare( $sql );
                return $prepared;
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
        
        return false;
    }
    
    public static function execute ( $sql, $params = null )
    {
        $statement = self::prepare( $sql, $params );
        
        if ( $statement )
        {
            return $statement->execute( $params );
        }
    }

    public static function select ( $query, $params = null ): array
    {
        $statement = self::prepare( $query, $params );
        
        if ( $statement )
        {
            $statement->execute( $params );
            return $statement->fetchAll( PDO::FETCH_OBJ );
        }
        
        return [];
    }

    // TODO prepare
    public static function insert ( $query )
    {
        $conn = DBUtil::getConnection();
        
        if ( $conn != null )
        {
            if ( $conn->query( $query ) )
            {
                return $conn->lastInsertId();
            }
            else
            {
                Logger::error( "Error occured while executing insert: '" . $query . "'" );
                return false;
            }
        }
        else
        {
            Logger::error( "No connection available while trying to execute insert: '" . $query . "'" );
        }
        
        return false;
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
