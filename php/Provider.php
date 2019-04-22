<?php

namespace php;

class Provider
{

    public static function getObjects ()
    {
        return Mapper::getInstance()->mapObjects();
    }
    
    public static function getObject ( $objectid )
    {
        return Mapper::getInstance()->mapObject( $objectid );
    }
    
    public static function getObjectDescriptions ()
    {
        return Mapper::getInstance()->mapObjectDescriptions();
    }

    public static function getComponents ()
    {
        return Mapper::getInstance()->mapComponents();
    }

    public static function getRooms ()
    {
        return Mapper::getInstance()->mapRooms();
    }
    
    public static function getRoom ( $roomid )
    {
        return Mapper::getInstance()->mapRoom( $roomid );
    }

    public static function getUsers ()
    {
        return Mapper::getInstance()->mapUsers();
    }
    
    public static function getUser ( $userid )
    {
        return Mapper::getInstance()->mapUser( $userid );
    }
}

