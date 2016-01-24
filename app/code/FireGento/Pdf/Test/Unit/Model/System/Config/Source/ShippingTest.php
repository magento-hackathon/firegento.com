<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use FireGento\Pdf\Model\System\Config\SourceTest;

class ShippingTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Shipping();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => '',
                    'label' => 'Hide shipping method',
                ],
                [
                    'value' => 'header',
                    'label' => 'Header',
                ],
                [
                    'value' => 'note',
                    'label' => 'Notes area',
                ],
            ],

            $this->sourceModel->toOptionArray()
        );
    }
}

