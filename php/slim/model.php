<?php

/**
 * 
 * @author dsu
 *
 */
interface ISavable
{

    public function save ();
}

/**
 *
 * @author dsu
 *        
 */
class MComponent implements ISavable
{
    private $componentid;
    
    // @var MComponentdescription
    private $componentdescription;
    
    // @var MComponentvalue
    private $componentvalue;

    public function __construct ( int $componentid, MComponentdescription $componentdescription, MComponentvalue $componentvalue )
    {
        $this->componentid = $componentid;
        $this->componentdescription = $componentdescription;
        $this->componentvalue = $componentvalue;
    }

    public function getComponentId (): int
    {
        return $this->componentid;
    }

    public function getComponentdescription (): MComponentdescription
    {
        return $this->componentdescription;
    }

    public function getComponentvalue (): MComponentvalue
    {
        return $this->componentvalue;
    }

    public function save ()
    {
        $this->componentdescription->save();
        $this->componentvalue->save();
    }
}

/**
 *
 * @author dsu
 *        
 */
class MComponentdescription implements ISavable
{
    private $componentdescriptionid;
    private $description;

    public function __construct ( int $id, string $desc )
    {
        $this->componentdescriptionid = $id;
        $this->description = $desc;
    }

    public function getComponentdescriptionId (): int
    {
        return $this->componentdescriptionid;
    }

    public function getDescription (): string
    {
        return $this->description;
    }

    public function save ()
    {}
}

/**
 *
 * @author dsu
 *        
 */
class MComponentvalue implements ISavable
{
    private $componentvalueid;
    private $value;

    public function __construct ( int $id, $value )
    {
        $this->componentvalueid = $id;
        $this->value = $value;
    }

    public function getComponentvalueId (): int
    {
        return $this->componentvalueid;
    }

    public function getValue (): string
    {
        return $this->value;
    }

    public function save ()
    {}
}

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

    public function getObjectId ()
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

/**
 *
 * @author dsu
 *        
 */
class MObjectdescription implements ISavable
{
    private $objectdescriptionid;
    private $description;

    public function getObjectdescriptionId ()
    {
        return $this->objectdescriptionid;
    }

    public function getDescription ()
    {
        return $this->description;
    }

    public function save ()
    {}
}

/**
 *
 * @author dsu
 *        
 */
class MRoom implements ISavable
{
    private $roomid;
    private $number;
    private $description;

    public function getRoomId ()
    {
        return $this->roomid;
    }

    public function getNumber ()
    {
        return $this->number;
    }

    public function getDescription ()
    {
        return $this->description;
    }

    public function save ()
    {}
}

/**
 *
 * @author dsu
 *        
 */
class MUser implements ISavable
{
    private $userid;
    private $name;
    private $firstname;
    private $email;
    private $password;

    public function getUser ()
    {
        return $this->userid;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function getFirstname ()
    {
        return $this->firstname;
    }

    public function getEmail ()
    {
        return $this->email;
    }

    public function getPassword ()
    {
        return $this->password;
    }

    public function save ()
    {}
}
