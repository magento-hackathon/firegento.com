<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class HeaderblocksTest extends \PHPUnit_Framework_TestCase
{

    public function testImplementsArrayInterface()
    {
        $this->assertInstanceOf(
            ArrayInterface::class,
            new Headerblocks()
        );
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
            (new Headerblocks())->toOptionArray()
        );
    }
}
