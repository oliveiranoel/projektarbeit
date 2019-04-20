<?php

namespace php\util;

class NavUtil
{
    public static function isActive ( $link )
    {
        echo $_SERVER["REQUEST_URI"] == $link ? "active" : "";
    }
}

