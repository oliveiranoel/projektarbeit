<?php

/**
 * ***********************************************************************************************************
 * ROOM
 */
// Hauptübersicht
RouteService::add( '/rooms', function ()
{
    Renderer::default( "Room", "room/overview.htm.php" );
} );

// Room editieren
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    $params = [
        "roomid" => $roomid
    ];
    Renderer::default( "Room", "room/edit.htm.php", $params );
} );

// Raum editieren - Formular absenden (speichern)
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    RoomDispatcher::update( $roomid );
}, "post" );

// Neuer Raum
RouteService::add( '/rooms/new', function ()
{
    Renderer::default( "Room", "room/new.htm.php" );
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
 * COMPONENT
 */
// Hauptübersicht
RouteService::add( '/components', function ()
{
    Renderer::default( "Component", "component/overview.htm.php" );
} );

// Room editieren
RouteService::add( '/components/([0-9]*)/edit', function ( $componentid )
{
    $params = [
        "componentid" => $componentid
    ];
    Renderer::default( "Component", "component/edit.htm.php", $params );
} );

// Raum editieren - Formular absenden (speichern)
RouteService::add( '/components/([0-9]*)/edit', function ( $componentid )
{
    ComponentDispatcher::update( $componentid );
}, "post" );

// Neuer RaumWow
RouteService::add( '/components/new', function ()
{
    Renderer::default( "Component", "component/new.htm.php" );
} );

// Neuer Raum - Formular absenden (speichern)
RouteService::add( '/components/new', function ()
{
    ComponentDispatcher::create();
}, "post" );

// Raum löschen
RouteService::add( '/components/([0-9]*)/delete', function ( $componentid )
{
    ComponentDispatcher::delete( $componentid );
}, "post" );

/**
 * ***********************************************************************************************************
 * USER
 */
// Benutzerübersicht
RouteService::add( '/users', function ()
{
    Renderer::default( "Benutzer", "user/overview.htm.php" );
} );

// Bentuzer editieren - Seitenaufruf
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    $params = [
        "userid" => $userid
    ];
    Renderer::default( "User", "user/edit.htm.php", $params );
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    UserDispatcher::update( $userid );
}, "post" );

RouteService::add( '/users/new', function ()
{
    Renderer::default( "Home", "user/new.htm.php" );
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
    Renderer::default( "Objekte", "object/overview.htm.php" );
} );

// Bentuzer editieren - Seitenaufruf
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    $params = [
        "objectid" => $objectid
    ];
    Renderer::default( "Objekte", "object/edit.htm.php", $params );
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    ObjectDispatcher::update( $objectid );
}, "post" );

RouteService::add( '/objects/new', function ()
{
    Renderer::default( "Objekte", "object/new.htm.php" );
} );

RouteService::add( '/objects/new', function ()
{
    ObjectDispatcher::create();
}, "post" );

RouteService::add( '/objects/([0-9]*)/delete', function ( $objectid )
{
    ObjectDispatcher::delete( $objectid );
}, "post" );

/**
 * ***********************************************************************************************************
 * HOME
 */
RouteService::add( '/home', function ()
{
    Renderer::default( "Home", "home.htm.php", null, null, null, true, true );
} );

/**
 * ***********************************************************************************************************
 * LOGIN & LOGOUT
 */
// Login - Seitenaufruf
RouteService::add( '/login.html', function ()
{
    Renderer::default( "Login", "login.htm.php", null, "login.css", null, false, false );
} );

// Login - Formular absenden (anmelden)
RouteService::add( '/login.html', function ()
{
    AuthorizerService::getInstance()->login();
}, "post" );

RouteService::add( '/logout.html', function ()
{
    AuthorizerService::getInstance()->logout();
    RouteService::redirect( "/login.html" );
}, "post" );

/**
 * ***********************************************************************************************************
 * REWRITE
 */
RouteService::rewrite( "/index.php", "/home" );
RouteService::rewrite( Config::BASEPATH, "/home" );

// WORKAROUND
// RouteService::rewrite( "/js/plugin/popper.min.js.map", "/home" );

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
    Renderer::default( "404", 'error/404.htm.php', $params );
} );

// 405
RouteService::methodNotAllowed( function ( $path, $method )
{
    $params = [
        "path" => $path,
        "method" => $method
    ];
    Renderer::default( "405", 'error/405.htm.php', $params );
} );

