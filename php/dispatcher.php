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

    public static function update ( $componentid )
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
        RouteService::redirect( "/components" );
    }

    public static function create ()
    {
        $description = $_POST[ "description" ];
        $value = $_POST[ "value" ];
        $descriptionId = 0;
        $valueId = 0;
        
        if ( empty( QueryUtil::query( "SELECT * FROM componentdescription WHERE lower(description) = lower('$description')" ) ) )
        {
            QueryUtil::execute( "INSERT INTO componentdescription ( description ) VALUES ( '$description' )" );
            $descriptionId = QueryUtil::query( "SELECT componentdescriptionid FROM componentdescription WHERE description = '$description'" )[ 0 ]->componentdescriptionid;
            var_dump( $descriptionId );
        }
        
        if ( empty( QueryUtil::query( "SELECT * FROM componentvalue WHERE lower(value) = lower('$value')" ) ) )
        {
            QueryUtil::execute( "INSERT INTO componentvalue ( value ) VALUES ( '$value' )" );
            $valueId = QueryUtil::query( "SELECT componentvalueid FROM componentvalue WHERE value = '$value'" )[ 0 ]->componentvalueid;
            var_dump( $valueId );
        }
        
        QueryUtil::execute( "INSERT INTO component ( componentdescriptionid, componentvalueid ) VALUES ( '$descriptionId', '$valueId' )" );
        
        RouteService::redirect( "/components" );
    }

    public static function delete ( $componentid )
    {
        $sql = "DELETE FROM component WHERE componentid = $componentid;";
        QueryUtil::execute( $sql );
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
