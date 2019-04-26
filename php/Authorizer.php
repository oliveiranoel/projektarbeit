<?php

namespace php;

use Config;
use php\util\TemplateUtil;
use php\util\QueryUtil;

class Authorizer
{
    protected static $instance = null;
    private static $session_auth_user = "AUTH_USER";

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

    public function authorize ()
    {
        if ( !isset( $_SESSION[ self::$session_auth_user ] ) )
        {
            header( 'HTTP/1.0 401 Unauthorized' );
            $_SESSION[ "PREVIOUS_REQUEST_PATH" ] = parse_url( $_SERVER[ "REQUEST_URI" ] )[ "path" ];
            RouteService::redirect( "/login.html" );
        }
    }
    
    public function logout ()
    {
        unset( $_SESSION[ self::$session_auth_user ] );
        session_destroy();
    }
    
    public function login ()
    {
        $success = false;
        $sql = "SELECT * FROM user WHERE email = '" . $_POST[ 'email' ] . "'";
        $record = QueryUtil::query( $sql );
        
        if ( !empty( $record ) )
        {
            if ( $record[0]->password == md5( $_POST[ "password" ] ) )
            {
                $_SESSION[ self::$session_auth_user ] = $_POST[ "email" ];
                $success = true;
            }
        }
        
        $this->handleRedirect( $success );
    }
    
    private function handleRedirect ( bool $success )
    {
        if ( $success )
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
        else
        {
            TemplateUtil::default( "Login", "login.htm.php", null, "login.css", "login.js", false, false );
        }
    }
}

