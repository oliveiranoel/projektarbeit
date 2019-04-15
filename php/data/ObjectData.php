<?php

namespace php\data;

use php\model\MObject;

/**
 *
 * @author dsu
 *        
 */
class ObjectData
{
    private $object;
    private $objectDescription;
    private $room;
    // @var ComponentData's
    private $components;

    public function __construct ( MObject $object, array $components )
    {
        $this->object = $object;
        $this->objectDescription = $object->getObjectdescription();
        $this->room = $object->getRoom();
    }

    public function getObjectDescription ()
    {
        return $this->objectDescription->getDescription();
    }

    public function getRoomDescription ()
    {
        return $this->room->getDescription();
    }

    public function getRoomNumber ()
    {
        return $this->room->getNumber();
    }

    public function getComponents ()
    {
        return $this->components;
    }
}

