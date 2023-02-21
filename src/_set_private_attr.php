<?php

namespace PMVC\PlugIn\unit;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\SetPriateAttr';

use ReflectionProperty; 

class SetPriateAttr
{
    public $caller;  

    public function __invoke($obj, $attrName, $newVal)
    {
        $prop = new ReflectionProperty($obj, $attrName);
        $prop->setAccessible(true);
        $prop->setValue($obj, $newVal);
        return true;
    }
}
