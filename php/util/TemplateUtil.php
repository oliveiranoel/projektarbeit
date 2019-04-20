<?php

namespace php\util;

use Config;

/**
 *
 * @author dsu
 *        
 */
class TemplateUtil
{
    private static $default_template = "default.htm.php";

    public static function exists ( $template )
    {
        if ( isset( $template ) )
        {
            return file_exists( $template ) && !is_dir( $template ) ? true : false;
        }
        else
        {
            return false;
        }
    }

    public static function default ( $title, $template, $stylesheets = [], $scripts = [], $params = [], bool $nav = true )
    {
        extract( (array) $params );
        $webroot = LinkUtil::getWebroot();
        $template = Config::PATH_TEMPLATE . $template;
        include ( Config::PATH_TEMPLATE . self::$default_template );
    }

    public static function stylesheets ( $stylesheets )
    {
        foreach ( (array) $stylesheets as $stylesheet )
        {
            echo "<link rel='stylesheet' href='" . Config::PATH_CSS . "$stylesheet'>";
        }
    }

    public static function scripts ( $scripts )
    {
        foreach ( (array) $scripts as $script )
        {
            echo "<script src='" . Config::PATH_JS . "$script'></script>";
        }
    }
}

