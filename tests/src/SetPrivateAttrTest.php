<?php

namespace PMVC\PlugIn\unit;

use PMVC\TestCase;

class SetPrivateAttrTest extends TestCase
{
    private $_plug = 'unit';

    public function testSetPrivateAttr()
    {
        $p = \PMVC\plug($this->_plug);    
        $o = new FakePrivateAttr();
        $old = $o->getP();
        $this->assertEquals('foo', $old);
        $p->set_private_attr(
            $o, '_p', 'bar'
        );
        $actual = $o->getP();
        $this->assertEquals('bar', $actual);
    }
}

class FakePrivateAttr
{
    private $_p = 'foo';

    public function getP()
    {
        return $this->_p; 
    }
}
