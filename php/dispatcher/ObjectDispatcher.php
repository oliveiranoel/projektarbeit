<?php

namespace php\dispatcher;

use php\RouteService;

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
        
        // $sql = "UPDATE user SET firstname = '$firstname', name = '$name', email = '$email', password
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

