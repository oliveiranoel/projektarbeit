<?php
namespace php\model;

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
    
    public function save()
    {
        
    }
}

