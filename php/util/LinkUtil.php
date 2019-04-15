<?php

namespace php\util;

use Config;

/**
 *
 * @author dsu
 *        
 */
class LinkUtil
{
    public static function getWebroot ()
    {
        return Config::BASEPATH . "/";
    }
}

