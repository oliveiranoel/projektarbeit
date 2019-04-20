<?php

namespace php\util;

use php\Logger;

class NavUtil
{
    public static function isActive ( $link )
    {
        echo $_SERVER["REQUEST_URI"] == $link ? "active" : "";
    }
}

