<?php

namespace PMVC;

use PHPUnit_Framework_TestCase;

class TestCasePHPVersion extends PHPUnit_Framework_TestCase
{
    protected function setup(): void
    {
        $this->altSetup();
    }

    protected function teardown(): void
    {
        if (is_callable([$this, 'pmvc_teardown'])) {
            $this->pmvc_teardown();
        }
    }
}
