<?php

/**
 * @author dsu, nol
 * 
 * Provides data for templates.
 */
class Provider
{

    public static function getObjects ()
    {
        return Mapper::mapObjects();
    }

    public static function getObject ( $objectid )
    {
        return self::handle( Mapper::mapObject( $objectid ) );
    }

    public static function getComponents ()
    {
        return Mapper::mapComponents();
    }

    public static function getComponent ( $componentid )
    {
        return self::handle( Mapper::mapComponent( $componentid ) );
    }

    public static function getRooms ()
    {
        return Mapper::mapRooms();
    }

    public static function getRoom ( $roomid )
    {
        return self::handle( Mapper::mapRoom( $roomid ) );
    }

    public static function getUsers ()
    {
        return Mapper::mapUsers();
    }

    public static function getUser ( $userid )
    {
        return self::handle( Mapper::mapUser( $userid ) );
    }

    private static function handle ( $data )
    {
        if ( $data ) return $data;
        RouteService::redirect( "/error/404.html" );
    }

    public static function getObjectComponents ()
    {
        return Mapper::mapObjectComponents();
    }
}

/**
 *
 * @author dsu, nol
 *
 * Maps query outputs to PHP model objects.
 *
 */
class Mapper
{
    public static function mapRooms ()
    {
        $data = [];
        
        foreach ( QueryUtil::select( "SELECT * FROM room" ) as $record )
        {
            $data[] = new MRoom( $record->roomid, $record->number, $record->description );
        }
        
        return $data;
    }

    public static function mapRoom ( $roomid )
    {
        $record = QueryUtil::select( "SELECT * FROM room WHERE roomid = $roomid" )[ 0 ];
        if ( !empty( $record ) )
        {
            $data = new MRoom( $record->roomid, $record->number, $record->description );
            return $data;
        }
        return false;
    }

    public static function mapObjects ()
    {
        $data = [];
        
        foreach ( QueryUtil::select( "SELECT * FROM object" ) as $record )
        {
            $objectdescription = QueryUtil::select( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
            $room = QueryUtil::select( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
            
            $data[] = new MObject( $record->objectid, new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), new MRoom( $room->roomid, $room->number, $room->description ) );
        }
        
        return $data;
    }

    public static function mapObject ( $objectid )
    {
        $record = QueryUtil::select( "SELECT * FROM object WHERE objectid = $objectid" );
        if ( !empty( $record ) )
        {
            $record = $record[ 0 ];
            $objectdescription = QueryUtil::select( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
            $room = QueryUtil::select( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
            $data = new MObject( $record->objectid, new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), new MRoom( $room->roomid, $room->number, $room->description ) );
            return $data;
        }
        return false;
    }

    public static function mapComponents ()
    {
        $data = [];
        
        foreach ( QueryUtil::select( "SELECT * FROM component" ) as $record )
        {
            $componentdescription = QueryUtil::select( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
            $componentvalue = QueryUtil::select( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
            
            $data[] = new MComponent( $record->componentid, new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        }
        
        return $data;
    }

    public static function mapComponent ( $componentid )
    {
        $record = QueryUtil::select( "SELECT * FROM component WHERE componentid = $componentid" );
        if ( !empty( $record ) )
        {
            $record = $record[ 0 ];
            $componentdescription = QueryUtil::select( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
            $componentvalue = QueryUtil::select( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
            $data = new MComponent( $record->componentid, new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
            return $data;
        }
        return false;
    }

    public static function mapUsers ()
    {
        $data = [];
        
        foreach ( QueryUtil::select( "SELECT * FROM user" ) as $record )
        {
            $data[] = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password, $record->admin );
        }
        
        return $data;
    }

    public static function mapUser ( $userid )
    {
        $record = QueryUtil::select( "SELECT * FROM user WHERE userid = $userid" );
        if ( !empty( $record ) )
        {
            $record = $record[ 0 ];
            $data = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password, $record->admin );
            return $data;
        }
        return false;
    }

    public static function mapObjectComponents ()
    {
        $data = [];
        
        foreach ( QueryUtil::select( "SELECT * FROM objectcomponentassign" ) as $record )
        {
            $data[] = new MObjectComponent( $record->objectid, $record->componentid );
        }
        
        return $data;
    }
}
