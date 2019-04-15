<?php
namespace php\model;

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
    
    
    public function save()
    {
        
    }

}

