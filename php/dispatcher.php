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
        $record = QueryUtil::select( $sql, [
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
        
        QueryUtil::insert( $sql, $params );
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

    private static function validate ( $message, $url )
    {
        if ( !Validator::alphanumeric( $_POST[ "number" ] ) )
        {
            Validator::message( $message, $url );
            return false;
        }
        return true;
    }

    public static function update ( $roomid )
    {
        if ( !self::validate( "Datensatz konnte nicht aktualisiert werden.", "/rooms/$roomid/edit" ) ) return;
        
        $sql = "UPDATE room SET number = ?, description = ? WHERE roomid = ?";
        $params = [
            $_POST[ "number" ],
            $_POST[ "description" ],
            $roomid
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/rooms" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/rooms/new" ) ) return;
        
        $sql = "INSERT INTO room ( number, description ) VALUES ( ?, ? )";
        $params = [
            $_POST[ "number" ],
            $_POST[ "description" ]
        ];
        
        QueryUtil::insert( $sql, $params );
        RouteService::redirect( "/rooms" );
    }

    public static function delete ( $roomid )
    {
        try
        {
            
            $sql = "DELETE FROM room WHERE roomid = ?";
            QueryUtil::execute( $sql, [
                $roomid
            ] );
            
            RouteService::redirect( "/rooms" );
        }
        catch ( PDOException $e )
        {
            Validator::message( "Aktion ist nicht erlaubt: Raum ist einem Objekt zugewiesen.", "/rooms" );
        }
    }
}

/**
 *
 * @author dsu
 *
 */
class ComponentDispatcher
{

    private static function validate ( $message, $url )
    {
        if ( !Validator::alphanumeric( $_POST[ "description" ] ) || !Validator::alphanumeric( $_POST[ "value" ] ) )
        {
            Validator::message( $message, $url );
            return false;
        }
        return true;
    }

    private static function checkDescriptionAssgin ( $description )
    {
        $select = "SELECT * FROM componentdescription WHERE lower(description) = lower( ? )";
        $insert = "INSERT INTO componentdescription ( description ) VALUES ( ? )";
        $params = [
            $description
        ];
        
        $record = QueryUtil::select( $select, $params );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( $insert, $params );
        }
        else
        {
            return $record[ 0 ]->componentdescriptionid;
        }
    }

    private static function checkValueAssgin ( $value )
    {
        $select = "SELECT * FROM componentvalue WHERE lower(value) = lower( ? )";
        $insert = "INSERT INTO componentvalue ( value ) VALUES ( ? )";
        $params = [
            $value
        ];
        
        $record = QueryUtil::select( $select, $params );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( $insert, $params );
        }
        else
        {
            return $record[ 0 ]->componentvalueid;
        }
    }

    public static function update ( $componentid )
    {
        if ( !self::validate( "Datensatz konnte nicht aktualisiert werden.", "/components/$componentid/edit" ) ) return;
        
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $valueId = self::checkValueAssgin( $_POST[ "value" ] );
        
        $sql = "UPDATE component SET componentdescriptionid = ?, componentvalueid = ? WHERE componentid = ?";
        $params = [
            $descriptionId,
            $valueId,
            $componentid
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/components" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/components/new" ) ) return;
        
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        $valueId = self::checkValueAssgin( $_POST[ "value" ] );
        
        $sql = "INSERT INTO component ( componentdescriptionid, componentvalueid ) VALUES ( ?, ? )";
        $params = [
            $descriptionId,
            $valueId
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/components" );
    }

    public static function delete ( $componentid )
    {
        try
        {
            $sql = "DELETE FROM component WHERE componentid = ?";
            QueryUtil::execute( $sql, [
                    $componentid
            ] );
            RouteService::redirect( "/components" );
        }
        catch ( PDOException $e )
        {
            Validator::message( "Aktion ist nicht erlaubt: Komponent ist einem Objekt zugewiesen.", "/components" );
        }
    }
}

/**
 *
 * @author dsu
 *
 */
class ObjectDispatcher
{

    private static function validate ( $message, $url )
    {
        if ( !Validator::alphanumeric( $_POST[ "description" ] ) )
        {
            Validator::message( $message, $url );
            return false;
        }
        return true;
    }

    private static function checkDescriptionAssgin ( $description )
    {
        $select = "SELECT * FROM objectdescription WHERE lower(description) = lower( ? )";
        $insert = "INSERT INTO objectdescription ( description ) VALUES ( ? )";
        $params = [
            $description
        ];
        
        $record = QueryUtil::select( $select, $params );
        if ( empty( $record ) )
        {
            return QueryUtil::insert( $insert, $params );
        }
        else
        {
            return $record[ 0 ]->objectdescriptionid;
        }
    }

    public static function update ( $objectid )
    {
        if ( !self::validate( "Datensatz konnte nicht aktualisiert werden.", "/objects/$objectid/edit" ) ) return;
        
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        
        $sql = "UPDATE object SET objectdescriptionid = ?, roomid = ? WHERE objectid = ?";
        $params = [
            $descriptionId,
            $_POST[ "room" ],
            $objectid
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/objects" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/objects/new" ) ) return;
        
        $descriptionId = self::checkDescriptionAssgin( $_POST[ "description" ] );
        
        $sql = "INSERT INTO object ( objectdescriptionid, roomid ) VALUES ( ?, ? )";
        $params = [
            $descriptionId,
            $_POST[ "room" ]
        ];
        
        QueryUtil::execute( $sql, $params );
        RouteService::redirect( "/objects" );
    }

    public static function delete ( $objectid )
    {
        QueryUtil::execute( "DELETE FROM object WHERE objectid = $objectid" );
        RouteService::redirect( "/objects" );
    }
}
