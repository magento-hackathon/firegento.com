<?php

namespace FireGento\Pdf\Model\System\Config\Source;

class HeaderblocksTest extends \PHPUnit_Framework_TestCase
{
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
            (new Headerblocks())->toOptionArray()
        );
    }
}
