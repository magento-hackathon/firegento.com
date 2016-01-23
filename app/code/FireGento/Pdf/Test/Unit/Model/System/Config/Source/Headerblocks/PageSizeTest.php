<?php

namespace FireGento\Pdf\Model\System\Config\Source\Headerblocks;

use FireGento\Pdf\Model\System\Config\SourceTest;

require_once __DIR__ . '/../../SourceTest.php';

class PageSizeTest extends SourceTest
{
    protected function setUp()
    {
        $this->sourceModel = new PageSize();
    }

    public function testToOptionArray()
    {
        $this->assertEquals(
            [
                [
                    'value' => \Zend_Pdf_Page::SIZE_A4,
                    'label' => __('DIN A4'),
                ],
                [
                    'value' => \Zend_Pdf_Page::SIZE_LETTER,
                    'label' => __('Letter'),
                ],
            ],
            $this->sourceModel->toOptionArray()
        );
    }
}
