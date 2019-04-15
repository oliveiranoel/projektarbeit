<?php
use php\Loader;
use php\RouteService;
use php\util\DBUtil;

session_start();

include_once 'config/config.php';
include_once 'config/routing.php';

spl_autoload_register( function ( $class ) {
    include_once __DIR__ . "\\" . $class . '.php';
});


DBUtil::connect( Config::SQL_DATABASE, Config::SQL_USER, Config::SQL_PASSWORD );

Loader::getInstance()->initModel();

RouteService::run();

?>