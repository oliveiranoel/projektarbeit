<?php
use php\Authorizer;
use php\RouteService;
use php\util\QueryUtil;
use php\util\TemplateUtil;

include_once 'php/RouteService.php';

RouteService::add( '/test.html', function ()
{
    if ( !isset( $_SESSION[ 'AUTH_USER' ] ) )
    {
        header( 'HTTP/1.0 401 Unauthorized' );
        $_SESSION[ "PREVIOUS_REQUEST_PATH" ] = parse_url( $_SERVER[ "REQUEST_URI" ] )[ "path" ];
        RouteService::redirect( "/login.html" );
    }
    else
    {
        TemplateUtil::default( "Test", "test.htm.php" );
        echo $_SESSION[ 'AUTH_USER' ];
        echo "<br>";
        echo $_SESSION[ 'AUTH_PW' ];
    }
} );

/**
 * ***********************************************************************************************************
 * ROOM
 */

// Hauptübersicht
RouteService::add( '/rooms', function ()
{
    TemplateUtil::default( "Room", "room/overview.htm.php" );
} );

// Room editieren
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    $params = array(
        "roomid" => $roomid
    );
    TemplateUtil::default( "Room", "room/edit.htm.php", $params );
} );

// Raum editieren - Formular absenden (speichern)
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    // TODO in eigene Klasse auslagern
    $number = $_POST[ "number" ];
    $description = $_POST[ "description" ];
    
    $sql = "UPDATE room SET number = '$number', description = '$description' WHERE roomid = $roomid";
    QueryUtil::execute( $sql );
    RouteService::redirect( "/rooms" );
}, "post" );

// Neuer Raum
RouteService::add( '/rooms/new', function ()
{
    TemplateUtil::default( "Room", "room/new.htm.php" );
} );

// Neuer Raum - Formular absenden (speichern)
RouteService::add( '/rooms/new', function ()
{
    // TODO in eigene Klasse auslagern
    $number = $_POST[ "number" ];
    $description = $_POST[ "description" ];
    
    $sql = "INSERT INTO room ( number, description )
            VALUES ( '$number','$description' )";
    QueryUtil::execute( $sql );
    RouteService::redirect( "/rooms" );
}, "post" );

// Raum löschen
RouteService::add( '/rooms/([0-9]*)/delete', function ( $roomid )
{
    // TODO in eigene Klasse auslagern und abfragen ob Benutzer wirklich gelöscht werden soll
    $sql = "DELETE FROM room WHERE roomid = $roomid";
    QueryUtil::execute( $sql );
    RouteService::redirect( "/rooms" );
}, "post" );

/**
 * ***********************************************************************************************************
 * HOME
 */
RouteService::add( '/home', function ()
{
    TemplateUtil::default( "Home", "home.htm.php" );
} );

/**
 * ***********************************************************************************************************
 * USER
 */

// Benutzerübersicht
RouteService::add( '/users', function ()
{
    TemplateUtil::default( "Benutzer", "user/overview.htm.php" );
} );

// Bentuzer editieren - Seitenaufruf
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    $params = [
        "userid" => $userid
    ];
    TemplateUtil::default( "User", "user/edit.htm.php", $params );
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    // TODO in eigene Klasse auslagern
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
}, "post" );

RouteService::add( '/users/new', function ()
{
    TemplateUtil::default( "Home", "user/new.htm.php" );
} );

RouteService::add( '/users/new', function ()
{
    // TODO in eigene Klasse auslagern
    $firstname = $_POST[ "firstname" ];
    $name = $_POST[ "name" ];
    $email = $_POST[ "email" ];
    $password = md5( $_POST[ "password" ] );
    
    $sql = "INSERT INTO user ( name, firstname, email, password )
            VALUES ( '$name','$firstname', '$email', '$password' )";
    QueryUtil::execute( $sql );
    RouteService::redirect( "/users" );
}, "post" );

RouteService::add( '/users/([0-9]*)/delete', function ( $userid )
{
    // TODO in eigene Klasse auslagern und abfragen ob Benutzer wirklich gelöscht werden soll
    $sql = "DELETE FROM user WHERE userid = $userid;";
    QueryUtil::execute( $sql );
    RouteService::redirect( "/users" );
}, "post" );

/**
 * ***********************************************************************************************************
 * OBJECT
 */

// Benutzerübersicht
RouteService::add( '/objects', function ()
{
    TemplateUtil::default( "Objekte", "object/overview.htm.php" );
} );

// Bentuzer editieren - Seitenaufruf
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    $params = [
        "objectid" => $objectid
    ];
    TemplateUtil::default( "Objekte", "object/edit.htm.php", $params );
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    // TODO in eigene Klasse auslagern
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
}, "post" );

RouteService::add( '/objects/new', function ()
{
    TemplateUtil::default( "Objekte", "object/new.htm.php" );
} );

RouteService::add( '/objects/new', function ()
{
    // TODO in eigene Klasse auslagern
    // $firstname = $_POST[ "firstname" ];
    // $name = $_POST[ "name" ];
    // $email = $_POST[ "email" ];
    // $password = md5( $_POST[ "password" ] );
    
    // $sql = "INSERT INTO user ( name, firstname, email, password )
    // VALUES ( '$name','$firstname', '$email', '$password' )";
    // QueryUtil::execute( $sql );
    RouteService::redirect( "/objects" );
}, "post" );

RouteService::add( '/objects/([0-9]*)/delete', function ( $userid )
{
    // TODO in eigene Klasse auslagern und abfragen ob Benutzer wirklich gelöscht werden soll
    // $sql = "DELETE FROM user WHERE userid = $userid;";
    // QueryUtil::execute( $sql );
    RouteService::redirect( "/objects" );
}, "post" );

/**
 * ***********************************************************************************************************
 * LOGIN & LOGOUT
 */

// Login - Seitenaufruf
RouteService::add( '/login.html', function ()
{
    TemplateUtil::default( "Login", "login.htm.php", null, "login.css", null, false );
} );

// Login - Formular absenden (anmelden)
RouteService::add( '/login.html', function ()
{
    Authorizer::getInstance()->login();
}, "post" );

RouteService::add( '/logout.html', function ()
{
    Authorizer::getInstance()->logout();
    RouteService::redirect( "/login.html" );
}, "post" );

/**
 * ***********************************************************************************************************
 * REWRITE
 */

RouteService::rewrite( "/index.php", "/home" );
RouteService::rewrite( Config::BASEPATH, "/home" );

/**
 * ***********************************************************************************************************
 * ERROR
 */

// 404
RouteService::pathNotFound( function ( $path )
{
    $params = [
        "path" => $path
    ];
    TemplateUtil::default( "404", 'error/404.htm.php', $params );
} );

// 405
RouteService::methodNotAllowed( function ( $path, $method )
{
    $params = [
        "path" => $path,
        "method" => $method
    ];
    TemplateUtil::default( "405", 'error/405.htm.php', $params );
} );

