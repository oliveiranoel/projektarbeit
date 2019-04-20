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
    
    public static function query ( $query ) : array
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

