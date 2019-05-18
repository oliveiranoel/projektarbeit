<?php

/**
 * Provides data.
 */
class Provider
{
    public static function getObjects ()
    {
        return Mapper::getInstance()->mapObjects();
    }

    public static function getObject ( $objectid )
    {
        return self::handle( Mapper::getInstance()->mapObject( $objectid ) );
    }

    public static function getComponents ()
    {
        return Mapper::getInstance()->mapComponents();
    }

    public static function getComponent ( $componentid )
    {
        return self::handle( Mapper::getInstance()->mapComponent( $componentid ) );
    }

    public static function getRooms ()
    {
        return Mapper::getInstance()->mapRooms();
    }

    public static function getRoom ( $roomid )
    {
        return self::handle( Mapper::getInstance()->mapRoom( $roomid ) );
    }

    public static function getUsers ()
    {
        return Mapper::getInstance()->mapUsers();
    }

    public static function getUser ( $userid )
    {
        return self::handle( Mapper::getInstance()->mapUser( $userid ) );
    }
    
    private static function handle ( $data )
    {
        if ( $data ) return $data;
        RouteService::redirect( "/error/404.html" );
    }

    public static function getObjectComponents ()
    {
        return Mapper::getInstance()->mapObjectComponents();
    }
}

/**
 *
 * @author dsu
 *        
 *         Maps query outputs to PHP model objects.
 *        
 */
class Mapper
{
    protected static $instance = null;

    public static function getInstance (): Mapper
    {
        if ( null === self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __clone ()
    {}

    protected function __construct ()
    {}

    public function mapRooms ()
    {
        $data = [];

        foreach ( QueryUtil::select( "SELECT * FROM room" ) as $record )
        {
            $data[] = new MRoom( $record->roomid, $record->number, $record->description );
        }

        return $data;
    }

    public function mapRoom ( $roomid )
    {
        $record = QueryUtil::select( "SELECT * FROM room WHERE roomid = $roomid" )[ 0 ];
        if ( !empty( $record ) )
        {
            $data = new MRoom( $record->roomid, $record->number, $record->description );
            return $data;
        }
        return false;
    }

    public function mapObjects ()
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

    public function mapObject ( $objectid )
    {
        $record = QueryUtil::select( "SELECT * FROM object WHERE objectid = $objectid" )[ 0 ];
        $objectdescription = QueryUtil::select( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
        $room = QueryUtil::select( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
        $data = new MObject( $record->objectid, new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), new MRoom( $room->roomid, $room->number, $room->description ) );
        return $data;
    }


    public function mapComponents ()
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

    public function mapComponent ( $componentid )
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

    public function mapUsers ()
    {
        $data = [];

        foreach ( QueryUtil::select( "SELECT * FROM user" ) as $record )
        {
            $data[] = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password, $record->admin );
        }

        return $data;
    }

    public function mapUser ( $userid )
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

    public function mapObjectComponents ()
    {
        $data = [];

        foreach ( QueryUtil::select( "SELECT * FROM objectcomponentassign" ) as $record )
        {
            $data[] = new MObjectComponent( $record->objectid, $record->componentid );
        }

        return $data;
    }
}
