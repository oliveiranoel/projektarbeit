<?php

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