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
            
            TemplateUtil::default( "Error", "error/500.htm.php", [
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
class TemplateUtil
{
    private static $default_template = "default.htm.php";
    private static $root = Config::BASEPATH . "/";

    public static function exists ( $template )
    {
        if ( isset( $template ) )
        {
            return file_exists( $template ) && !is_dir( $template ) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public static function default ( $title, $template, $params = [], $stylesheets = [], $scripts = [], bool $nav = true, bool $user = true )
    {
        if ( $user && Config::LOCKDOWN )
        {
            Authorizer::getInstance()->authorize();
        }
        
        extract( (array) $params ); // Create variables from params
        $webroot = self::$root;
        $template = Config::PATH_TEMPLATE . $template;
        include ( Config::PATH_TEMPLATE . self::$default_template );
    }

    public static function stylesheets ( $stylesheets )
    {
        foreach ( (array) $stylesheets as $stylesheet )
        {
            echo "<link rel='stylesheet' href='" . Config::PATH_CSS . "$stylesheet'>";
        }
    }

    public static function scripts ( $scripts )
    {
        foreach ( (array) $scripts as $script )
        {
            echo "<script src='" . Config::PATH_JS . "$script'></script>";
        }
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