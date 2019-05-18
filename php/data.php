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

    public static function getComponent ( $componentid )
    {
        return Mapper::getInstance()->mapComponent( $componentid );
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

        foreach ( QueryUtil::query( "SELECT * FROM room" ) as $record )
        {
            $data[] = new MRoom( $record->roomid, $record->number, $record->description );
        }

        return $data;
    }

    public function mapRoom ( $roomid )
    {
        $record = QueryUtil::query( "SELECT * FROM room WHERE roomid = $roomid" )[ 0 ];
        $data = new MRoom( $record->roomid, $record->number, $record->description );
        return $data;
    }

    public function mapObjects ()
    {
        $data = [];
        

        foreach ( QueryUtil::query( "SELECT * FROM object" ) as $record )
        {
            $objectdescription = QueryUtil::query( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
            $room = QueryUtil::query( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
            $data[] = new MObject( $record->objectid, new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), new MRoom( $room->roomid, $room->number, $room->description ) );
        }
        

        return $data;
    }

    public function mapObject ( $objectid )
    {
        $record = QueryUtil::query( "SELECT * FROM object WHERE objectid = $objectid" )[ 0 ];
        $objectdescription = QueryUtil::query( "SELECT * FROM objectdescription WHERE objectdescriptionid = $record->objectdescriptionid" )[ 0 ];
        $room = QueryUtil::query( "SELECT * FROM room WHERE roomid = $record->roomid" )[ 0 ];
        $data = new MObject( $record->objectid, new MObjectdescription( $objectdescription->objectdescriptionid, $objectdescription->description ), new MRoom( $room->roomid, $room->number, $room->description ) );
        return $data;
    }

    public function mapObjectDescriptions ()
    {
        $data = [];

        foreach ( QueryUtil::query( "SELECT * FROM objectdescription" ) as $record )
        {
            $data[] = new MObjectdescription( $record->objectdescriptionid, $record->description );
        }

        return $data;
    }

    public function mapComponents ()
    {
        $data = [];

        foreach ( QueryUtil::query( "SELECT * FROM component" ) as $record )
        {
            $componentdescription = QueryUtil::query( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
            $componentvalue = QueryUtil::query( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];

            $data[] = new MComponent( $record->componentid, new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        }

        return $data;
    }

    public function mapComponent ( $componentid )
    {
        $record = QueryUtil::query( "SELECT * FROM component WHERE componentid = $componentid" )[ 0 ];
        $componentdescription = QueryUtil::query( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
        $componentvalue = QueryUtil::query( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
        $data = new MComponent( $record->componentid, new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ), new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        return $data;
    }

    public function mapUsers ()
    {
        $data = [];

        foreach ( QueryUtil::query( "SELECT * FROM user" ) as $record )
        {
            $data[] = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password, $record->admin );
        }

        return $data;
    }

    public function mapUser ( $userid )
    {
        $record = QueryUtil::query( "SELECT * FROM user WHERE userid = $userid" )[ 0 ];
        $data = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password, $record->admin );
        return $data;
    }

    public function mapObjectComponents ()
    {
        $data = [];

        foreach ( QueryUtil::query( "SELECT * FROM objectcomponentassign" ) as $record )
        {
            $data[] = new MObjectComponent( $record->objectid, $record->componentid );
        }

        return $data;
    }
}
