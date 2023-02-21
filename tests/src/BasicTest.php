<?php
namespace PMVC\PlugIn\unit;

use PMVC\TestCase;

class BasicTest extends TestCase
{
    private $_plug = 'unit';
    function testPlugin()
    {
        ob_start();
        print_r(\PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->haveString($this->_plug,$output);
    }

}
