<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use FireGento\Pdf\Model\System\Config\SourceTest;

require_once __DIR__ . '/../SourceTest.php';

class HeaderblocksTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Headerblocks();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => 'left',
                    'label' => 'Left',
                ],
                [
                    'value' => 'right',
                    'label' => 'Right',
                ],
            ],
            $this->sourceModel->toOptionArray()
        );
    }
}
