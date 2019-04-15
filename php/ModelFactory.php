<?php

namespace php;

use php\model\MComponent;
use php\model\MComponentdescription;
use php\model\MComponentvalue;
use php\util\DBUtil;
use php\util\QueryUtil;
use php\model\MUser;

class ModelFactory
{
    protected static $instance = null;
    const SESSION_VAR_COMPONENTS = "components";
    const SESSION_VAR_OBJECTS = "objects";

    public static function getInstance (): ModelFactory
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

    public function build ()
    {
        // TODO implement correctly
        $data = array(
            "components" => self::createComponents(),
            "users" => self::createUsers(),
            "objects" => self::createObjects()
        );
        return $data;
    }

    private function createObjects ()
    {
        // TODO implement
        $data = [];
        return $data;
    }

    private function createUsers ()
    {
        $data = [];
        
        foreach ( self::query( "SELECT * FROM user" ) as $record )
        {
            $data[] = new MUser( $record->userid, $record->name, $record->firstname, $record->email, $record->password );
        }
        
        Logger::log( "creating users" );
        return $data;
    }

    private function createComponents ()
    {
        $data = [];
        
        foreach ( self::query( "SELECT * FROM component" ) as $record )
        {
            $componentdescription = self::query( "SELECT * FROM componentdescription WHERE componentdescriptionid = $record->componentdescriptionid" )[ 0 ];
            $componentvalue = self::query( "SELECT * FROM componentvalue WHERE componentvalueid = $record->componentvalueid" )[ 0 ];
            
            $data[] = new MComponent( $record->componentid, 
                    new MComponentdescription( $componentdescription->componentdescriptionid, $componentdescription->description ),
                    new MComponentvalue( $componentvalue->componentvalueid, $componentvalue->value ) );
        }
        
        Logger::log( "creating components" );
        return $data;
    }

    private function query ( $query )
    {
        return QueryUtil::query( $query, DBUtil::getConnection() );
    }
}

