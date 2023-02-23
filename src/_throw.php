<?php

namespace PMVC;

use Exception;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\WrapThrow';

class WrapThrow
{
    public $caller;

    public function handleError(
        $number,
        $message,
        $file = null,
        $line = null,
        $context = null
    ) {
        /**
         * https://www.php.net/manual/en/errorfunc.constants.php
         * 256	E_USER_ERROR (int)
         */
        if ($number <= 256) {
            throw new Exception($message, $number);
        }
    }

    public function __invoke($willThrow, $caller, $phpunit, $error = true)
    {
        set_error_handler([$this, 'handleError']);
        $annotation = \PMVC\plug('annotation');
        $doc = $annotation->get($caller, true);
        $expectedException = get($doc, 'expectedException');
        $expectedExceptionMessage = get($doc, 'expectedExceptionMessage');
        if (!empty($expectedException)) {
            $phpunit->expectException($expectedException);
        }
        if (!empty($expectedExceptionMessage)) {
            $phpunit->expectExceptionMessage($expectedExceptionMessage);
        }
        if (!$error) {
            $willThrow();
        } else {
            try {
                $willThrow();
            } catch (Exception $e) {
                if (is_bool($error)) {
                    $error = 'PMVC\PMVCUnitException';
                }
                throw new $error($e->getMessage(), 0);
            }
        }
    }
}
