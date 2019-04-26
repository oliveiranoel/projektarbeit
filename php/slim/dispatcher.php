<?php
use php\RouteService;
use php\util\QueryUtil;

class UserDispatcher
{

    public static function update ( $userid )
    {
        $firstname = $_POST[ "firstname" ];
        $name = $_POST[ "name" ];
        $email = $_POST[ "email" ];
        $password = $_POST[ "password" ];
        
        $pw = "SELECT * FROM user WHERE userid = $userid";
        $record = QueryUtil::query( $pw )[ 0 ];
        
        if ( $record->password != $password )
        {
            $password = md5( $password );
        }
        
        $sql = "UPDATE user SET firstname = '$firstname', name = '$name', email = '$email', password = '$password' WHERE userid = $userid";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/users" );
    }

    public static function create ()
    {
        $firstname = $_POST[ "firstname" ];
        $name = $_POST[ "name" ];
        $email = $_POST[ "email" ];
        $password = md5( $_POST[ "password" ] );
        
        $sql = "INSERT INTO user ( name, firstname, email, password )
            VALUES ( '$name','$firstname', '$email', '$password' )";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/users" );
    }

    public static function delete ( $userid )
    {
        $sql = "DELETE FROM user WHERE userid = $userid;";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/users" );
    }
}

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

class ObjectDispatcher
{

    public static function update ( $objectid )
    {
        // TODO implement
        // $firstname = $_POST[ "firstname" ];
        // $name = $_POST[ "name" ];
        // $email = $_POST[ "email" ];
        // $password = $_POST[ "password" ];
        
        // $pw = "SELECT * FROM user WHERE userid = $userid";
        // $record = QueryUtil::query( $pw )[ 0 ];
        
        // if ( $record->password != $password )
        // {
        // $password = md5( $password );
        // }
        
        // $sql = "UPDATE user SET firstname = '$firstname', name = '$name', email = '$email',
        // password
        // = '$password' WHERE userid = $userid";
        // QueryUtil::execute( $sql );
        RouteService::redirect( "/objects" );
    }

    public static function create ()
    {
        // TODO implement
        // $firstname = $_POST[ "firstname" ];
        // $name = $_POST[ "name" ];
        // $email = $_POST[ "email" ];
        // $password = md5( $_POST[ "password" ] );
        
        // $sql = "INSERT INTO user ( name, firstname, email, password )
        // VALUES ( '$name','$firstname', '$email', '$password' )";
        // QueryUtil::execute( $sql );
        RouteService::redirect( "/objects" );
    }

    public static function delete ( $objectid )
    {
        // TODO implement
        // $sql = "DELETE FROM user WHERE userid = $userid;";
        // QueryUtil::execute( $sql );
        RouteService::redirect( "/objects" );
    }
}
