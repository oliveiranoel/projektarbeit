<?php

namespace php;

// TODO rewrite to logging to log file not console
/**
 *
 * @author dsu
 *        
 */
class Logger
{

    public static function log ( $string )
    {
        echo "<script type='text/javascript'>console.log('" . addslashes( $string ) . "')</script>";
    }

    public static function error ( $string )
    {
        echo "<script type='text/javascript'>console.error('" . addslashes( $string ) . "')</script>";
    }

    public static function warn ( $string )
    {
        echo "<script type='text/javascript'>console.warn('" . addslashes( $string ) . "')</script>";
    }
}

