<?php
use php\Logger;

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
            Logger::log( "Error occured while trying to connect to database: " . $e->getMessage() );
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

    public static function execute ( $sql, $conn )
    {
        try
        {
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

    public static function query ( $query, $conn ): array
    {
        try
        {
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

    public static function exists ( $template )
    {
        return file_exists( $template ) && !is_dir( $template ) ? true : false;
    }

    public static function parse ( $title, $template, $stylesheets = [], $scripts = [], bool $nav = true )
    {
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