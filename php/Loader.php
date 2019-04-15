<?php

namespace php;

class Loader
{
    protected static $instance = null;
    const SESSION_VAR_DATA = "data";

    public static function getInstance (): Loader
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

    public function initModel ()
    {
        if ( !isset( $_SESSION[ self::SESSION_VAR_DATA ] ) )
        {
            $_SESSION[ self::SESSION_VAR_DATA ] = ModelFactory::getInstance()->build();
        }
    }
}

