<?php

namespace PMVC;

use Exception;

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__ . '\WrapThrow';

class WrapThrow
{
    public function __invoke($willThrow, $caller, $phpunit, $error = true)
    {
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
                throw new PMVCUnitException($e->getMessage(), 0);
            }
        }
    }
}
