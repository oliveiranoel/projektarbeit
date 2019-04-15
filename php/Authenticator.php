<?php

namespace php;

use php\util\TemplateUtil;
include_once 'php/util/TemplateUtil.php';
include_once 'php/util/LinkUtil.php';

class Authenticator
{
    protected static $instance = null;

    public static function getInstance (): Authenticator
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

    public function login ()
    {
        if ( $_SERVER[ "REQUEST_METHOD" ] === "POST" )
        {
            self::authenticate( $_POST[ "email" ], $_POST[ "password" ] );
        }
        
        self::handleAuth();
    }
    
    public function isAuthorised ()
    {
        
    }

    private function authenticate ( $email, $password )
    {
        // TODO implement
        $_SESSION[ 'AUTH_USER' ] = $email;
        $_SESSION[ 'AUTH_PW' ] = md5( $password ); // maybe doesnt need to be in session
    }

    private function handleAuth ()
    {
        if ( !isset( $_SESSION[ 'AUTH_USER' ] ) )
        {
            TemplateUtil::parse( "Login", "login.htm.php", "login.css", null, null, false );
        }
        else
        {
            if ( isset( $_SESSION[ "PREVIOUS_REQUEST_URI" ] ) )
            {
                redirect( $_SESSION[ "PREVIOUS_REQUEST_URI" ] );
                unset( $_SESSION[ "PREVIOUS_REQUEST_URI" ] );
            }
            else
            {
                redirect( "/projektarbeit/home" );
            }
        }
    }
}

