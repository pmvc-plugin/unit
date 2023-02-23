<?php

namespace PMVC\PlugIn\unit;

use PMVC\TestCase;

class PMVCMockBuilderTest extends TestCase
{
    public function testGetPMVCMock()
    {
        $mock = $this->getPMVCMockBuilder(FakeDebugMock::class)
            ->pmvc_onlyMethods(['a'])
            ->getMock();
        $mock->expects($this->atLeastOnce())->method('a');

        $actual = $mock->a();
        $this->assertEquals($actual, null);
        $this->assertEquals((new FakeDebugMock())->a(), 'foo');
    }
}

class FakeDebugMock
{
    public function a()
    {
        return 'foo';
    }
}
