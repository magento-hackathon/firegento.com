<?php

namespace FireGento\Pdf\Model\System\Config\Source\Creditmemo;

use FireGento\Pdf\Model\System\Config\SourceTest;

class EngineTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new Engine();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => '',
                    'label' => 'Standard Magento',
                ],
                [
                    'value' => 'firegento_pdf/engine_creditmemo_default',
                    'label' => 'Standard FireGento',
                ],
            ],

            $this->sourceModel->toOptionArray()
        );
    }
}