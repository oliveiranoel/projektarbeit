<?php

namespace php;

class Provider
{

    public static function getObjects ()
    {
        return Mapper::getInstance()->mapObjects();
    }

    public static function getComponents ()
    {
        return Mapper::getInstance()->mapComponents();
    }

    public static function getRooms ()
    {
        return Mapper::getInstance()->mapRooms();
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

