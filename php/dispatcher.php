<?php

/***************************************************************************************************************
 *
 *  This file contains all dispatcher classes.
 *  
 *  A dispatcher is used to handle an action when the specific URL is invoked with POST
 *  e.g. "/user/new" is called, then the corresponding method UserDispatcher#create gets executed.
 *  
 *  These classes are used in the routing.php file.
 *
 ***************************************************************************************************************/

/**
 *
 * @author dsu, nol
 * 
 * Dispatcher for URL /users*
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
        QueryUtil::execute( $sql, [
            $_POST[ "firstname" ],
            $_POST[ "name" ],
            $_POST[ "email" ],
            $_POST[ "password" ],
            $_POST[ "admin" ],
            $userid
        ] );
        RouteService::redirect( "/users" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/users/new" ) ) return;
        
        $sql = "INSERT INTO user ( name, firstname, email, password, admin ) VALUES ( ?, ?, ?, ?, ? )";
        QueryUtil::insert( $sql, [
            $_POST[ "firstname" ],
            $_POST[ "name" ],
            $_POST[ "email" ],
            md5( $_POST[ "password" ] ),
            $_POST[ "admin" ]
        ] );
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
 * @author dsu, nol
 * 
 * Dispatcher for URL /rooms*
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
        QueryUtil::execute( $sql, [
            $_POST[ "number" ],
            $_POST[ "description" ],
            $roomid
        ] );
        RouteService::redirect( "/rooms" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/rooms/new" ) ) return;
        
        $sql = "INSERT INTO room ( number, description ) VALUES ( ?, ? )";
        QueryUtil::insert( $sql, [
            $_POST[ "number" ],
            $_POST[ "description" ]
        ] );
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
 * @author dsu, nol
 * 
 * Dispatcher for URL /components*
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
        
        $sql = "UPDATE component SET componentdescriptionid = ?, componentvalueid = ? WHERE componentid = ?";
        QueryUtil::execute( $sql, [
            self::checkDescriptionAssgin( $_POST[ "description" ] ),
            self::checkValueAssgin( $_POST[ "value" ] ),
            $componentid
        ] );
        RouteService::redirect( "/components" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/components/new" ) ) return;
        
        $sql = "INSERT INTO component ( componentdescriptionid, componentvalueid ) VALUES ( ?, ? )";
        QueryUtil::execute( $sql, [
            self::checkDescriptionAssgin( $_POST[ "description" ] ),
            self::checkValueAssgin( $_POST[ "value" ] )
        ] );
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
 * @author dsu, nol
 * 
 * Dispatcher for URL /objects*
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
        
        $sql = "UPDATE object SET objectdescriptionid = ?, roomid = ? WHERE objectid = ?";
        QueryUtil::execute( $sql, [
            self::checkDescriptionAssgin( $_POST[ "description" ] ),
            $_POST[ "room" ],
            $objectid
        ] );
        RouteService::redirect( "/objects" );
    }

    public static function create ()
    {
        if ( !self::validate( "Datensatz konnte nicht gespeichert werden.", "/objects/new" ) ) return;
        
        $sql = "INSERT INTO object ( objectdescriptionid, roomid ) VALUES ( ?, ? )";
        QueryUtil::execute( $sql, [
            self::checkDescriptionAssgin( $_POST[ "description" ] ),
            $_POST[ "room" ]
        ] );
        RouteService::redirect( "/objects" );
    }

    public static function delete ( $objectid )
    {
        $sql = "DELETE FROM objectcomponentassign WHERE objectid = ?";
        QueryUtil::execute( $sql, [
                $objectid
        ] );
        
        $sql = "DELETE FROM object WHERE objectid = ?";
        QueryUtil::execute( $sql, [
            $objectid
        ] );
        RouteService::redirect( "/objects" );
    }
}

/**
 *
 * @author dsu, nol
 *
 * Dispatcher for URL /assigns*
 *
 */
class AssignDispatcher
{

    public static function update ( $objectid, $componentid )
    {
        try
        {
            $sql = "UPDATE objectcomponentassign SET objectid = ?, componentid = ? WHERE objectid = ? AND componentid = ?";
            QueryUtil::execute( $sql, [
                    $_POST[ "object" ],
                    $_POST[ "component" ],
                    $objectid,
                    $componentid
            ] );
            RouteService::redirect( "/assigns" );
        }
        catch ( PDOException $e )
        {
            Validator::message( "Aktion ist nicht erlaubt: Zuweisung existiert bereits.", "/assigns/$objectid/$componentid/edit" );
        }
    }

    public static function create ()
    {
        try 
        {
            $sql = "INSERT INTO objectcomponentassign ( objectid, componentid ) VALUES ( ?, ? )";
            QueryUtil::execute( $sql, [
                $_POST[ "object" ],
                $_POST[ "component" ]
            ] );
            RouteService::redirect( "/assigns" );
        }
        catch ( PDOException $e )
        {
            Validator::message( "Aktion ist nicht erlaubt: Zuweisung existiert bereits.", "/assigns/new" );
        }
    }

    public static function delete ( $objectid, $componentid )
    {
        $sql = "DELETE FROM objectcomponentassign WHERE objectid = ? AND componentid = ?";
        QueryUtil::execute( $sql, [
            $objectid,
            $componentid
        ] );
        RouteService::redirect( "/assigns" );
    }
}
