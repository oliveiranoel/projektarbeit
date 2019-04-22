<?php

namespace php\dispatcher;

use php\RouteService;
use php\util\QueryUtil;

class RoomDispatcher
{
    public static function update ( $roomid )
    {
        $number = $_POST[ "number" ];
        $description = $_POST[ "description" ];
        
        $sql = "UPDATE room SET number = '$number', description = '$description' WHERE roomid = $roomid";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }
 
    public static function create ()
    {
        $number = $_POST[ "number" ];
        $description = $_POST[ "description" ];
        
        $sql = "INSERT INTO room ( number, description )
            VALUES ( '$number','$description' )";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }
    
    public static function delete ( $roomid )
    {
        $sql = "DELETE FROM room WHERE roomid = $roomid";
        QueryUtil::execute( $sql );
        RouteService::redirect( "/rooms" );
    }
}

