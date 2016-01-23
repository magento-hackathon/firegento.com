<?php

namespace FireGento\Pdf\Model\System\Config\Source\Headerblocks;

use Magento\Framework\Option\ArrayInterface;

class PageSize implements ArrayInterface
{
    public function toOptionArray()
    {
        $positions = [
            \Zend_Pdf_Page::SIZE_A4     => __('DIN A4'),
            \Zend_Pdf_Page::SIZE_LETTER => __('Letter'),
        ];

        $options = [];
        foreach ($positions as $k => $v) {
            $options[] = [
                'value' => $k,
                'label' => $v,
            ];
        }

        return $options;
    }
}
