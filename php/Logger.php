<?php

/**
 * 
 * @author dsu, nol
 * 
 * The Logger is used to log messages to the dev console.
 *
 */
class Logger
{

    public static function log ( $str )
    {
        echo "<script type='text/javascript'>console.log('" . addslashes( $str ) . "')</script>";
    }

    public static function error ( $str )
    {
        echo "<script type='text/javascript'>console.error('" . addslashes( $str ) . "')</script>";
    }

    public static function warn ( $str )
    {
        echo "<script type='text/javascript'>console.warn('" . addslashes( $str ) . "')</script>";
    }

    public static function alert ( $str )
    {
        echo "<script type='text/javascript'>alert('" . addslashes( $str ) . "')</script>";
    }
}