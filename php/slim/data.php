<?php

/**
 * 
 * @author dsu
 *
 */
class ComponentData
{
    private $component;
    private $componentDescription;
    private $componentValue;

    public function __construct ( MComponent $component )
    {
        $this->component = $component;
        $this->componentDescription = $component->getComponentdescription();
        $this->componentValue = $component->getComponentvalue();
    }

    public function getDescription ()
    {
        return $this->componentDescription->getDescription();
    }

    public function getValue ()
    {
        return $this->componentValue->getValue();
    }
}

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