<?php

namespace php;

use Config;
use php\util\TemplateUtil;
include_once 'php/util/TemplateUtil.php';

// TODO use cookies instead of session
class Authorizer
{
    protected static $instance = null;

    public static function getInstance (): Authorizer
    {
        if ( null === self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __clone ()
    {}

    protected function __construct ()
    {}

    public function authorize (  )
    {
        if ( !isset( $_SESSION[ 'AUTH_USER' ] ) )
        {
            header( 'HTTP/1.0 401 Unauthorized' );
            $_SESSION[ "PREVIOUS_REQUEST_PATH" ] = parse_url( $_SERVER[ "REQUEST_URI" ] )[ "path" ];
            RouteService::redirect( "/login.html" );
        }
    }
    
    public function login ()
    {
        // TODO mit DB implementieren und vlt mit $_COOKIE
        $_SESSION[ 'AUTH_USER' ] = $_POST[ "email" ];
        $_SESSION[ 'AUTH_PW' ] = md5( $_POST[ "password" ] ); // TODO muss nicht in der Session gespeichert sein (nur für testing)
        
        // TODO PREVIOUS_REQUEST_PATH braucht es vlt nicht
        if ( isset( $_SESSION[ "PREVIOUS_REQUEST_PATH" ] ) )
        {
            RouteService::redirect( str_replace( Config::BASEPATH, '', $_SESSION[ "PREVIOUS_REQUEST_PATH" ] ) );
            unset( $_SESSION[ "PREVIOUS_REQUEST_PATH" ] );
        }
        else
        {
            RouteService::redirect( "/home" );
        }
    }
    
    public function logout ()
    {
        unset( $_SESSION[ 'AUTH_USER' ] );
        unset( $_SESSION[ 'AUTH_PW' ] ); // TODO nur für testing
    }
}

