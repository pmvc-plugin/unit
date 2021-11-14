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
    if (!class_exists('TypeError')) {
        class TypeError extends Exception
        {
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
        protected $call_construct;

        public function __construct()
        {
            $this->call_construct = true;
            $args = func_get_args();
            return call_user_func_array('parent::__construct', $args);
        }

        protected function altSetup()
        {
            if (!$this->call_construct) {
                echo <<<EOF

### !!important ###
#
# You should not overwrite testcase __construct, 
# else will get error such as
# "TypeError: array_merge( ..." etc.
# Use pmvc_setup instead. 
#
### !!important ###

EOF;
            }
            if (is_callable([$this, 'pmvc_setup'])) {
                $this->pmvc_setup();
            }
        }

        protected function haveString($needle, $haystack)
        {
            if (is_callable([$this, 'assertStringContainsString'])) {
                $this->assertStringContainsString($needle, $haystack);
            } else {
                $this->assertContains($needle, $haystack);
            }
        }

        protected function willThrow($willThrow, $error = true)
        {
            $traces = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $func = $traces[1]['function'];
            \PMVC\plug('unit')->throw(
                $willThrow,
                [$this, $func],
                $this,
                $error
            );
        }
    }
}
