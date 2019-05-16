<?php

/***************************************************************************************************************
 *
 *  This file contains all dispatcher classes.
 *
 ***************************************************************************************************************/

/**
 *
 * @author dsu
 *
 */
class UserDispatcher
{
    private static function validate ( $message, $url )
    {
        if ( !Validator::validateUser( $_POST[ "firstname" ], $_POST[ "name" ], $_POST[ "email" ], $_POST[ "admin" ] ) )
        {
            Validator::message( $message, $url );
            return false;
        }
        return true;
    }
    
    public static function update ( $userid )
    {
        if ( !self::validate( "Datensatz konnte nicht aktualisiert werden.", "/users/$userid/edit" ) ) return;
        
        $sql = "SELECT * FROM user WHERE userid = ?";
        
        $record = QueryUtil::execute( $sql, [
                $userid
        ] )[ 0 ];
        
        if ( $record->password != $_POST[ "password" ] )
        {
            $_POST[ "password" ] = md5( $_POST[ "password" ] );
        }
        
        $sql = "UPDATE user SET firstname = ?, name = ?, email = ?, password = ?, admin = ? WHERE userid = ?";
        $params = [
                $_POST[ "firstname" ],
                $_POST[ "name" ],
                $_POST[ "email" ],
                $_POST[ "password" ],
                $_POST[ "admin" ],
                $userid
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/users" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/users/new" ) ) return;
        
        $sql = "INSERT INTO user ( name, firstname, email, password, admin ) VALUES ( ?, ?, ?, ?, ? )";
        $params = [
                $_POST[ "firstname" ],
                $_POST[ "name" ],
                $_POST[ "email" ],
                md5( $_POST[ "password" ] ),
                $_POST[ "admin" ]
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/users" );
    }

    public static function delete ( $userid )
    {
        $sql = "DELETE FROM user WHERE userid = ?";
        
        QueryUtil::execute( $sql, [
                $userid
        ] );
        
        RouteService::redirect( "/users" );
    }
}

/**
 *
 * @author dsu
 *
 */
class RoomDispatcher
{

    public static function update ( $roomid )
    {
        $number = $_POST[ "number" ];
        $description = $_POST[ "description" ];
        
        $sql = "UPDATE room SET number = '$number', description = '$description' WHERE roomid = $roomid";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }

    public static function create ()
    {
        $number = $_POST[ "number" ];
        $description = $_POST[ "description" ];
        
        $sql = "INSERT INTO room ( number, description )
            VALUES ( '$number','$description' )";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }

    public static function delete ( $roomid )
    {
        $sql = "DELETE FROM room WHERE roomid = $roomid";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }
}

/**
 *
 * @author dsu
 *
 */
class ComponentDispatcher
{

    private static function checkDescriptionAssgin ( $description )
    {
        $record = QueryUtil::select( "SELECT * FROM componentdescription WHERE lower(description) = lower('$description')" );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( "INSERT INTO componentdescription ( description ) VALUES ( '$description' )" );
        }
        else
        {
            return $record[0]->componentdescriptionid;
        }
    }
    
    private static function checkValueAssgin ( $value )
    {
        $record = QueryUtil::select( "SELECT * FROM componentvalue WHERE lower(value) = lower('$value')" );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( "INSERT INTO componentvalue ( value ) VALUES ( '$value' )" );
        }
        else
        {
            return $record[0]->componentvalueid;
        }
    }
    
    public static function update ( $componentid )
    {
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $valueId = self::checkValueAssgin( $_POST[ "value" ] );
        
        QueryUtil::execute( "UPDATE component SET componentdescriptionid = '$descriptionId', 
                                componentvalueid = '$valueId' WHERE componentid = $componentid" );
        RouteService::redirect( "/components" );
    }

    public static function create ()
    {
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $valueId = self::checkValueAssgin( $_POST[ "value" ] );
        
        QueryUtil::execute( "INSERT INTO component ( componentdescriptionid, componentvalueid ) VALUES ( '$descriptionId', '$valueId' )" );
        RouteService::redirect( "/components" );
    }

    public static function delete ( $componentid )
    {
        QueryUtil::execute( "DELETE FROM component WHERE componentid = $componentid" );
        RouteService::redirect( "/components" );
    }
}

/**
 *
 * @author dsu
 *
 */
class ObjectDispatcher
{
    private static function checkDescriptionAssgin ( $description )
    {
        $record = QueryUtil::select( "SELECT * FROM objectdescription WHERE lower(description) = lower('$description')" );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( "INSERT INTO objectdescription ( description ) VALUES ( '$description' )" );
        }
        else
        {
//             $id = $record[0]->objectdescriptionid;
//             QueryUtil::execute( "UPDATE objectdescription SET description = '$description' WHERE objectdescriptionid = $id" );
//             return $id;
            return $record[0]->objectdescriptionid;
        }
    }
    
    public static function update ( $objectid )
    {
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $roomId = $_POST["room"];
        
        QueryUtil::execute( "UPDATE object SET objectdescriptionid = '$descriptionId', roomid = '$roomId' WHERE objectid = $objectid" );
        RouteService::redirect( "/objects" );
    }
    
    public static function create ()
    {
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $roomId = $_POST["room"];
        
        QueryUtil::execute( "INSERT INTO object ( objectdescriptionid, roomid ) VALUES ( '$descriptionId', '$roomId' )" );
        RouteService::redirect( "/objects" );
    }
    
    public static function delete ( $objectid )
    {
        QueryUtil::execute( "DELETE FROM object WHERE objectid = $objectid" );
        RouteService::redirect( "/objects" );
    }
}
