<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use FireGento\Pdf\Model\System\Config\SourceTest;

class PaymentTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Payment();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => '',
                    'label' => 'Hide payment method',
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

