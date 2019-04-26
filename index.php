<?php
use php\RouteService;
use php\util\DBUtil;

session_start();

include_once 'config/config.php';
include_once 'config/routing.php';

// TODO slim aktiv machen
// foreach ( glob( Config::PATH_PHP . '*.php' ) as $file )
// {
//     include_once $filename;
// }

spl_autoload_register( function ( $class )
{
    include_once __DIR__ . '\\' . $class . '.php';
} );


DBUtil::connect( Config::SQL_DATABASE, Config::SQL_USER, Config::SQL_PASSWORD );

RouteService::run();

?>