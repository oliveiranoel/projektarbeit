<?php
namespace php\model;

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
    
    public function getComponentdescriptionId () : int
    {
        return $this->componentdescriptionid;
    }
    
    public function getDescription () : string
    {
        return $this->description;
    }
    
    public function save()
    {
        
    }

}

