<?php

class MComponent
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
}

class MComponentdescription
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
}

class MComponentvalue
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
}

class MObject
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
}

class MObjectdescription
{
    private $objectdescriptionid;
    private $description;
    
    public function __construct ( int $objectdescriptionid, string $description )
    {
        $this->objectdescriptionid = $objectdescriptionid;
        $this->description = $description;
    }
    
    public function getObjectdescriptionId ()
    {
        return $this->objectdescriptionid;
    }
    
    public function getDescription ()
    {
        return $this->description;
    }
}

class MRoom
{
    private $roomid;
    private $number;
    private $description;
    
    public function __construct ( int $roomid, string $number, string $description )
    {
        $this->roomid = $roomid;
        $this->number = $number;
        $this->description = $description;
    }
    
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
}

class MUser
{
    private $userid;
    private $name;
    private $firstname;
    private $email;
    private $password;
    
    public function __construct ( int $userid, string $name, string $firstname, string $email, string $password )
    {
        $this->userid = $userid;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }
    
    public function getUserid ()
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
}


