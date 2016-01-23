<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use FireGento\Pdf\Model\System\Config\SourceTest;

class LogoTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Logo();
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
                    'value' => 'center',
                    'label' => 'Center',
                ],
                [
                    'value' => 'right',
                    'label' => 'Right',
                ],
                [
                    'value' => 'full_width',
                    'label' => 'Full width',
                ],
            ],

            $this->sourceModel->toOptionArray()
        );
    }
}

