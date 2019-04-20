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
 * OVERALL
 */

// Hauptübersicht
RouteService::add( '/overview', function ()
{
    TemplateUtil::default( "Overview", "overview/overview.htm.php" );
} );

// Home
RouteService::add( '/home', function ()
{
    TemplateUtil::default( "Home", "home.htm.php" );
} );

/**
 * ***********************************************************************************************************
 * LOGIN
 */

// Login - Seitenaufruf
RouteService::add( '/login.html', function ()
{
    TemplateUtil::default( "Login", "login.htm.php", "login.css", null, null, false );
} );

// Login - Formular absenden (anmelden)
RouteService::add( '/login.html', function ()
{
    Authorizer::getInstance()->login();
}, "post" );

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
    $params = array(
        "userid" => $userid
    );
    TemplateUtil::default( "User", "user/edit.htm.php", null, null, $params );
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
    echo $record->password . " " . $password;
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
    TemplateUtil::default( "404", 'error/404.htm.php', null, null, $params );
} );

// 405
RouteService::methodNotAllowed( function ( $path, $method )
{
    $params = [
        "path" => $path,
        "method" => $method
    ];
    TemplateUtil::default( "405", 'error/405.htm.php', null, null, $params );
} );

