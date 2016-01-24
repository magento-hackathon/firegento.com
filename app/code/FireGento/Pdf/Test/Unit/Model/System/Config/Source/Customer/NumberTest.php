<?php

namespace FireGento\Pdf\Model\System\Config\Source\Customer;

use FireGento\Pdf\Model\System\Config\SourceTest;

class NumberTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Number();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => '',
                    'label' => 'Standard (entity_id)',
                ],
                [
                    'value' => 'increment_id',
                    'label' => 'Customer Increment ID (increment_id)',
                ],
            ],

            $this->sourceModel->toOptionArray()
        );
    }
}