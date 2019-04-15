<?php

namespace php\data;

use php\model\MComponent;

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

