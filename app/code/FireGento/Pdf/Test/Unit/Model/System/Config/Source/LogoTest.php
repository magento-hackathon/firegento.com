<?php

namespace FireGento\Pdf\Model\System\Config\Source;

class LogoTest extends \PHPUnit_Framework_TestCase
{

    public function testContainsAllNeeded()
    {
        $logo = new Logo();
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

            $logo->toOptionArray()
        );
    }
}

