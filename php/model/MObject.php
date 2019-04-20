<?php

namespace php\model;

/**
 *
 * @author dsu
 *        
 */
class MObject implements ISavable
{
    private $objectid;
    // @var MObjectdescription
    private $objectdescription;
    // @var MRoom
    private $room;

    public function __construct ( int $objectid, MObjectdescription $objectdescription, MRoom $room )
    {
        $this->objectid = $objectid;
        $this->objectdescription = $objectdescription;
        $this->room = $room;
    }

    public function getObjectid ()
    {
        return $this->objectid;
    }

    public function getObjectdescription (): MObjectdescription
    {
        return $this->objectdescription;
    }

    public function getRoom (): MRoom
    {
        return $this->room;
    }

    public function save ()
    {
        $this->objectdescription->save();
        $this->room->save();
    }
}

