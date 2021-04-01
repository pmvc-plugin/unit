<?php

namespace PMVC;

use PHPUnit_Framework_TestCase;

class TestCasePHPVersion extends PHPUnit_Framework_TestCase
{
    protected function setup()
    {
        if (is_callable([$this, 'pmvc_setup'])) {
            $this->pmvc_setup();
        }
    }

    protected function teardown()
    {
        if (is_callable([$this, 'pmvc_teardown'])) {
            $this->pmvc_teardown();
        }
    }

    public function testNone()
    {
        $this->assertFalse(false);
    }

    public function expectException($exception)
    {
        if (is_callable('parent::expectException')) {
          parent::expectException($exception);
        }
    }

    public function expectExceptionMessage($message)
    {
        if (is_callable('parent::expectExceptionMessage')) {
          parent::expectExceptionMessage($message);
        }
    }
}
