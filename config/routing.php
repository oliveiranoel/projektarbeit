<?php

/**
 * ***********************************************************************************************************
 * ASSIGN
 */
// Hauptübersicht
RouteService::add( '/assigns', function ()
{
    Renderer::default( "Assigns", "assign/overview.htm.php" );
} );

// Assign editieren - Seitenaufruf
RouteService::add( '/assigns/([0-9]*)/([0-9]*)/edit', function ( $objectid, $componentid )
{
    Renderer::default( "Assigns", "assign/edit.htm.php", [
        "objectid" => $objectid,
        "componentid" => $componentid
    ] );
} );

// Assign editieren - Formular absenden (speichern)
RouteService::add( '/assigns/([0-9]*)/([0-9]*)/edit', function ( $objectid, $componentid )
{
    AssignDispatcher::update( $objectid, $componentid );
}, "post" );

// Neues Assign - Seitenaufruf
RouteService::add( '/assigns/new', function ()
{
    Renderer::default( "Assigns", "assign/new.htm.php" );
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
    Renderer::default( "R&auml;ume", "room/overview.htm.php" );
} );

// Raum editieren - Seitenaufruf
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    Renderer::default( "R&auml;ume", "room/edit.htm.php", [
        "roomid" => $roomid
    ] );
} );

// Raum editieren - Formular absenden (speichern)
RouteService::add( '/rooms/([0-9]*)/edit', function ( $roomid )
{
    RoomDispatcher::update( $roomid );
}, "post" );

// Neuer Raum - Seitenaufruf
RouteService::add( '/rooms/new', function ()
{
    Renderer::default( "R&auml;ume", "room/new.htm.php" );
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
    Renderer::default( "Komponenten", "component/overview.htm.php" );
} );

// Komponent editieren - Seitenaufruf
RouteService::add( '/components/([0-9]*)/edit', function ( $componentid )
{
    Renderer::default( "Komponenten", "component/edit.htm.php", [
        "componentid" => $componentid
    ] );
} );

// Komponent editieren - Formular absenden (speichern)
RouteService::add( '/components/([0-9]*)/edit', function ( $componentid )
{
    ComponentDispatcher::update( $componentid );
}, "post" );

// Neuer Komponent - Seitenaufruf
RouteService::add( '/components/new', function ()
{
    Renderer::default( "Komponenten", "component/new.htm.php" );
} );

// Neuer Komponent - Formular absenden (speichern)
RouteService::add( '/components/new', function ()
{
    ComponentDispatcher::create();
}, "post" );

// Komponent löschen
RouteService::add( '/components/([0-9]*)/delete', function ( $componentid )
{
    ComponentDispatcher::delete( $componentid );
}, "post" );

/**
 * ***********************************************************************************************************
 * USER
 */
// Hauptübersicht
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
        Renderer::default( "User", "user/edit.htm.php", [
            "userid" => $userid
        ] );
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

// Neuer Bentuzer - Seitenaufruf
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

// Neuer Bentuzer - Formular absenden (speichern)
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

// Bentuzer löschen
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
// Hauptübersicht
RouteService::add( '/objects', function ()
{
    Renderer::default( "Objekte", "object/overview.htm.php" );
} );

// Objekt editieren - Seitenaufruf
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    Renderer::default( "Objekte", "object/edit.htm.php", [
        "objectid" => $objectid
    ] );
} );

// Objekt editieren - Formular absenden (speichern)
RouteService::add( '/objects/([0-9]*)/edit', function ( $objectid )
{
    ObjectDispatcher::update( $objectid );
}, "post" );

// Neues Objekt - Seitenaufruf
RouteService::add( '/objects/new', function ()
{
    Renderer::default( "Objekte", "object/new.htm.php" );
} );

// Neues Objekt - Formular absenden (speichern)
RouteService::add( '/objects/new', function ()
{
    ObjectDispatcher::create();
}, "post" );

// Objekt löschen
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

/**
 * ***********************************************************************************************************
 * ERROR
 */
// 404
RouteService::pathNotFound( function ( $path )
{
    Renderer::default( "404", 'error/404.htm.php', [
        "path" => $path
    ] );
} );

// 405
RouteService::methodNotAllowed( function ( $path, $method )
{
    Renderer::default( "405", 'error/405.htm.php', [
        "path" => $path,
        "method" => $method
    ] );
} );

