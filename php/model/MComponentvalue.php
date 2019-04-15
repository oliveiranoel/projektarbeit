<?php
namespace php\model;

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
    
    public function getComponentvalueId () : int
    {
        return $this->componentvalueid;
    }
    
    public function getValue () : string
    {
        return $this->value;
    }
    
    public function save()
    {
        
    }
}

