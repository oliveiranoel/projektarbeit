<?php

/***************************************************************************************************************
 *
 *  This file contains all utility classes
 *
 ***************************************************************************************************************/

/**
 *
 * @author dsu, nol
 *
 * Utitily for database.
 * Main purpose is to create the connection
 * between application and database.
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
            Logger::error( $msg . ": " . $e->getMessage() );
            
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
 * @author dsu, nol
 *
 * Utitily for queries.
 * Main purpose is to execute queries.
 *
 */
class QueryUtil
{

    private static function handleNoConnection ( $conn, $sql )
    {
        if ( $conn == null )
        {
            Logger::error( "No connection available while trying to execute query: '" . $sql . "'" );
            return false;
        }
        return true;
    }

    private static function prepare ( $sql )
    {
        try
        {
            $conn = DBUtil::getConnection();
            
            if ( self::handleNoConnection( $conn, $sql ) )
            {
                $prepared = $conn->prepare( $sql );
                return $prepared;
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
        $statement = self::prepare( $sql );
        
        if ( $statement )
        {
            return $statement->execute( $params );
        }
    }

    public static function select ( $query, $params = null ): array
    {
        $statement = self::prepare( $query );
        
        if ( $statement )
        {
            $statement->execute( $params );
            return $statement->fetchAll( PDO::FETCH_OBJ );
        }
        
        return [];
    }

    public static function insert ( $query, $params = null )
    {
        $conn = DBUtil::getConnection();
        
        try
        {
            if ( self::handleNoConnection( $conn, $query ) )
            {
                $prepared = $conn->prepare( $query );
                
                if ( $prepared->execute( $params ) )
                {
                    return $conn->lastInsertId();
                }
                else
                {
                    Logger::error( "Error occured while executing insert: '" . $query . "'" );
                }
            }
        }
        catch ( PDOException $e )
        {
            Logger::error( "Error occured while executing query: '" . $query . "'" );
        }
        
        return false;
    }
}

/**
 *
 * @author dsu, nol
 *
 * Utitily for navigation.
 *
 */
class NavUtil
{

    /**
     * Checks if the current navigation is active,
     * if yes set class active to nav.
     *
     * @param string $link
     */
    public static function isActive ( $link )
    {
        echo $_SERVER[ "REQUEST_URI" ] == $link ? "active" : "";
    }
}

/**
 *
 * @author dsu, nol
 *
 * Utitily for file.
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
