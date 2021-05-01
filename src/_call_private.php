<?php

namespace PMVC\PlugIn\unit;

use ReflectionMethod;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\CallPrivate';

class CallPrivate
{
    public function __invoke($class, $methodName, $args = null, $obj = null)
    {
        if (is_null($obj)) {
            $obj = new $class();
        }
        $reflector = new ReflectionMethod($class, $methodName);
        $reflector->setAccessible(true);
        if (is_null($args)) {
            $args = [];
        }
        return $reflector->invoke($obj, ...$args);
    }
}
