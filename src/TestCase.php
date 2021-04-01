<?php

namespace {
    if (!class_exists('PHPUnit_Framework_TestCase')) {
        class PHPUnit_Framework_TestCase extends \PHPUnit\Framework\TestCase
        {
        }
        class PHPUnit_Framework_Error extends Exception
        {
            public function __construct(
                $message = '',
                $code = 0,
                $file = null,
                $line = null
            ) {
                parent::__construct($message, $code);
            }
        }
    }
}

namespace PMVC {
    $phpver = (int) phpversion();

    if ($phpver >= 8) {
        l(__DIR__ . '/TestCase-8');
    } else {
        l(__DIR__ . '/TestCase-5');
    }

    class PMVCUnitException extends \Exception
    {
        public function __construct(
            $message = '',
            $code = 0,
            $file = null,
            $line = null
        ) {
            parent::__construct($message, $code);
        }
    }

    class TestCase extends TestCasePHPVersion
    {
        protected function haveString($needle, $haystack)
        {
            if (is_callable([$this, 'assertStringContainsString'])) {
                $this->assertStringContainsString($needle, $haystack);
            } else {
                $this->assertContains($needle, $haystack);
            }
        }

        public function testNone()
        {
            $this->assertFalse(false);
        }
    }
}
