<?php

/**
 * ***********************************************************************************************************
 * ASSIGN
 */
// Hauptübersicht
RouteService::add( '/assigns', function ()
{
    Renderer::default( "Assign", "assign/overview.htm.php" );
} );

// Assign editieren
RouteService::add( '/assigns/([0-9]*)/([0-9]*)/edit', function ( $objectid, $componentid )
{
    $params = [
        "objectid" => $objectid,
        "componentid" => $componentid
    ];
    Renderer::default( "Assign", "assign/edit.htm.php", $params );
} );

// Assign editieren - Formular absenden (speichern)
RouteService::add( '/assigns/([0-9]*)/([0-9]*)/edit', function ( $objectid, $componentid )
{
    AssignDispatcher::update( $objectid, $componentid );
}, "post" );

// Neues Assign
RouteService::add( '/assigns/new', function ()
{
    Renderer::default( "Assign", "assign/new.htm.php" );
} );

// Neues Assign - Formular absenden (speichern)
RouteService::add( '/assigns/new', function ()
{
    AssignDispatcher::create();
}, "post" );

// Assign löschen
RouteService::add( '/assigns/([0-9]*)/([0-9]*)/delete', function ( $objectid, $componentid )
{
    AssignDispatcher::delete( $objectid, $componentid );
}, "post" );

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
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        Renderer::default( "Benutzer", "user/overview.htm.php" );
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
} );

// Bentuzer editieren - Seitenaufruf
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        $params = [
            "userid" => $userid
        ];
        
        Renderer::default( "User", "user/edit.htm.php", $params );
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
} );

// Bentuzer editieren - Formular absenden (speichern)
RouteService::add( '/users/([0-9]*)/edit', function ( $userid )
{
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        UserDispatcher::update( $userid );
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
}, "post" );

RouteService::add( '/users/new', function ()
{
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        Renderer::default( "Home", "user/new.htm.php" );
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
} );

RouteService::add( '/users/new', function ()
{
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        UserDispatcher::create();
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
}, "post" );

RouteService::add( '/users/([0-9]*)/delete', function ( $userid )
{
    if ( isset( $_SESSION[ "AUTH_ROLE" ] ) )
    {
        UserDispatcher::delete( $userid );
    }
    else
    {
        Renderer::default( "401", 'error/401.htm.php' );
    }
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
    Renderer::default( "Home", "home/home.htm.php" );
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
    Authorizer::login();
}, "post" );

RouteService::add( '/logout.html', function ()
{
    Authorizer::logout();
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

