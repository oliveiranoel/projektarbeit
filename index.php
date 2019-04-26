<?php

session_start();

include_once 'config/config.php';

foreach ( glob( Config::PATH_PHP . '*.php' ) as $file )
{
    include_once $file;
}

include_once 'config/routing.php';

DBUtil::connect( Config::SQL_DATABASE, Config::SQL_USER, Config::SQL_PASSWORD );
RouteService::run();

