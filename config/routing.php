<?php
use php\Authorizer;
use php\RouteService;
use php\dispatcher\RoomDispatcher;
use php\dispatcher\UserDispatcher;
use php\util\TemplateUtil;
use php\dispatcher\ObjectDispatcher;

include_once 'php/RouteService.php';

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
    $params = [
        "roomid" => $roomid
    ];
    TemplateUtil::default( "Room", "room/edit.htm.php", $params );
} );

// Raum editieren - Formular absenden (speichern)
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    RoomDispatcher::update( $roomid );
}, "post" );

// Neuer Raum
RouteService::add( '/rooms/new', function ()
{
    TemplateUtil::default( "Room", "room/new.htm.php" );
} );

// Neuer Raum - Formular absenden (speichern)
RouteService::add( '/rooms/new', function ()
{
    RoomDispatcher::create();
}, "post" );

// Raum löschen
RouteService::add( '/rooms/([0-9]*)/delete', function ( $roomid )
{
    RoomDispatcher::delete( $roomid );
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
    $params = [
        "userid" => $userid
    ];
    TemplateUtil::default( "User", "user/edit.htm.php", $params );
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    UserDispatcher::update( $userid );
}, "post" );

RouteService::add( '/users/new', function ()
{
    TemplateUtil::default( "Home", "user/new.htm.php" );
} );

RouteService::add( '/users/new', function ()
{
    UserDispatcher::create();
}, "post" );

RouteService::add( '/users/([0-9]*)/delete', function ( $userid )
{
    UserDispatcher::delete( $userid );
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
    ObjectDispatcher::update( $objectid );
}, "post" );

RouteService::add( '/objects/new', function ()
{
    TemplateUtil::default( "Objekte", "object/new.htm.php" );
} );

RouteService::add( '/objects/new', function ()
{
    ObjectDispatcher::create();
}, "post" );

RouteService::add( '/objects/([0-9]*)/delete', function ( $userid )
{
    ObjectDispatcher::delete( $objectid );
}, "post" );

/**
 * ***********************************************************************************************************
 * HOME
 */
RouteService::add( '/home', function ()
{
    TemplateUtil::default( "Home", "home.htm.php", null, null, null, true, false );
} );

/**
 * ***********************************************************************************************************
 * LOGIN & LOGOUT
 */
// Login - Seitenaufruf
RouteService::add( '/login.html', function ()
{
    TemplateUtil::default( "Login", "login.htm.php", null, "login.css", null, false, false );
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

