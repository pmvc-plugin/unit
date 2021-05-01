<?php
namespace PMVC\PlugIn\unit;

use PMVC\TestCase;

class CallPrivateTest extends TestCase
{
    private $_plug = 'unit';
    public function testCallPrivate()
    {
        $p = \PMVC\plug($this->_plug);    
        $result = $p->callPrivate(
            __NAMESPACE__.'\FakePrivate', '_iAmPrivate'
        );
        $this->assertEquals('call me', $result);
    }

    public function testWithConstruct()
    {
        $fake = new FakePrivate('foo');
        $p = \PMVC\plug($this->_plug);    
        $result = $p->callPrivate(
            __NAMESPACE__.'\FakePrivate', '_returnPrivateP', null, $fake
        );
        $this->assertEquals('foo', $result);
    }

    public function testWithArgs()
    {
        $p = \PMVC\plug($this->_plug);    
        $result = $p->callPrivate(
            __NAMESPACE__.'\FakePrivate', '_returnArgs', ['bar'] 
        );
        $this->assertEquals('bar', $result);
    }
}

class FakePrivate {
    private $_p;

    public function __construct($p = null)
    {
        $this->_p = $p;
    }

    private function _returnPrivateP()
    {
        return $this->_p; 
    }

    private function _returnArgs($arg1)
    {
        return $arg1; 
    }

    private function _iAmPrivate()
    {
        return 'call me';
    }
}
