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
        private $_bInit;

        private function _overwriteConstructWarn()
        {
            $pUnit = \PMVC\plug('unit');
            if (!$pUnit['disableOverwriteConstructWarn']) {
                $annot = \PMVC\plug('annotation');
                $doc = $annot->get([$this, '__construct']);
                $docFile = $doc->getfile();
                $isOverwriteConstruct = strpos($docFile, '/phpunit/');
                if (false === $isOverwriteConstruct) {
                    $docLine = $doc->getStartLine();
                    echo <<<EOF

### !!important ###
#
# You should not overwrite testcase __construct, 
# else will get error such as
# "TypeError: array_merge( ..." etc.
# Use pmvc_init instead. 
# Please check ${docFile}
# Line: ${docLine}
#
### !!important ###

EOF;
                }
            }
        }

        private function _init()
        {
            if ($this->_bInit) {
                return;
            } else {
                $this->_bInit = true;
            }
            $this->_overwriteConstructWarn();
            if (is_callable([$this, 'pmvc_init'])) {
                $this->pmvc_init();
            }
        }

        protected function altSetup()
        {
            $this->_init();
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
