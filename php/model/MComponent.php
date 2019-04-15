<?php
namespace php\model;

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
    
    public function getComponentId () : int
    {
        return $this->componentid;
    }
    
    public function getComponentdescription () : MComponentdescription
    {
        return $this->componentdescription;
    }
    
    public function getComponentvalue () : MComponentvalue
    {
        return $this->componentvalue;
    }
    
    public function save()
    {
        $this->componentdescription->save();
        $this->componentvalue->save();
    }

}

