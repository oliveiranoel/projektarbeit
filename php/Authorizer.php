<?php

namespace php;

use Config;
use php\util\TemplateUtil;
include_once 'php/util/TemplateUtil.php';
include_once 'php/util/LinkUtil.php';

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

    // TODO mit DB implementieren und vlt mit $_COOKIE
    public function login ()
    {
        $_SESSION[ 'AUTH_USER' ] = $_POST[ "email" ];
        $_SESSION[ 'AUTH_PW' ] = md5( $_POST[ "password" ] ); // TODO muss nicht in der Session gespeichert sein (nur für testing)
        
        if ( !isset( $_SESSION[ 'AUTH_USER' ] ) )
        {
            TemplateUtil::default( "Login", "login.htm.php", "login.css", null, null, false );
        }
        else
        {
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
    }
    
    public function logout ()
    {
        unset( $_SESSION[ 'AUTH_USER' ] );
        unset( $_SESSION[ 'AUTH_PW' ] ); // TODO nur für testing
    }
}

