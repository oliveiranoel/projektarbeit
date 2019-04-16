<?php
use php\util\TemplateUtil;
use php\RouteService;
use php\Authenticator;

include_once 'php/RouteService.php';



// -----------------------------------------------------------------------------------------------------------
// BEGINN URL MAPPING
// -----------------------------------------------------------------------------------------------------------

RouteService::add( '/template.html', function ()
{
    TemplateUtil::parse( "template", "template.htm.php" );
} );

RouteService::add( '/test.html',
        function ()
        {
            // TODO transfer this logic to Authenticator.php and/or TemplateUtil
            if ( !isset( $_SESSION[ 'AUTH_USER' ] ) )
            {
                header( 'HTTP/1.0 401 Unauthorized' );
                RouteService::redirect( "/login.html" );
                $_SESSION[ "PREVIOUS_REQUEST_URI" ] = $_SERVER[ "REQUEST_URI" ];
            }
            else
            {
                echo $_SESSION[ 'AUTH_USER' ];
                echo "<br>";
                echo $_SESSION[ 'AUTH_PW' ];
                TemplateUtil::parse( "Test", "test.htm.php" );
            }
        } );

RouteService::add( '/home', function ()
{
    TemplateUtil::parse( "Home", "home.htm.php" );
} );

RouteService::add( '/login.html', function ()
{
    Authenticator::getInstance()->login();
}, [
    "get",
    "post"
] );

// Übersicht der Benutzer
RouteService::add( '/users', function ()
{
    TemplateUtil::parse( "Home", "user/overview.htm.php" );
} );

// Hauptübersicht
RouteService::add( '/overview', function ()
{
    TemplateUtil::parse( "Overview", "overview/overview.htm.php" );
} );

// Ansicht eines einzelnen Benutzer
RouteService::add( '/users/([0-9]*)',
        function ( $userid )
        {
            $params = array(
                "userid" => $userid
            );
            TemplateUtil::parse( "User", "user/detailview.htm.php", null, null, $params );
        } );

// bearbeiten eines Benutzers
RouteService::add( '/users/([0-9]*)/edit',
        function ( $userid )
        {
            $params = array(
                "userid" => $userid
            );
            TemplateUtil::parse( "User", "user/edit.htm.php", null, null, $params );
        } );

// redirecting
RouteService::rewrite( "/index.php", "/home" );
RouteService::rewrite( Config::BASEPATH, "/home" );

// 404
RouteService::pathNotFound( function ( $path )
{
    $params = [
        "path" => $path
    ];
    TemplateUtil::parse( "404", 'error/404.htm.php', null, null, $params );
} );

// 405
RouteService::methodNotAllowed( 
        function ( $path, $method )
        {
            $params = [
                "path" => $path,
                "method" => $method
            ];
            TemplateUtil::parse( "405", 'error/405.htm.php', null, null, $params );
        } );

// -----------------------------------------------------------------------------------------------------------
// END URL MAPPING
// -----------------------------------------------------------------------------------------------------------

// Simple test route that simulates static html file
// Post route example
RouteService::add( '/contact-form', function ()
{
    echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
}, 'get' );
// Post route example
RouteService::add( '/contact-form', function ()
{
    echo 'Hey! The form has been sent:<br/>';
    print_r( $_POST );
}, 'post' );
// Get and Post route example
RouteService::add( '/get-post-sample',
        function ()
        {
            echo 'You can GET this page and also POST this form back to it';
            echo '<form method="post"><input type="text" name="input" /><input type="submit" value="send" /></form>';
            if ( isset( $_POST[ "input" ] ) )
            {
                echo 'I also received a POST with this data:<br/>';
                print_r( $_POST );
            }
        }, [
            'get',
            'post'
        ] );

// 405 test
RouteService::add( '/this-route-is-defined', function ()
{
    echo 'You need to patch this route to see this content';
}, 'patch' );

