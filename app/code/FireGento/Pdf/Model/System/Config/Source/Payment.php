<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Payment implements ArrayInterface
{

    const POSITION_HEADER = 'header';
    const POSITION_NOTE = 'note';

    /**
     * Return array of possible positions.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $positions = array(
            '' => Mage::helper('firegento_pdf')->__('Hide payment method'),
            self::POSITION_HEADER => Mage::helper('firegento_pdf')->__('Header'),
            self::POSITION_NOTE => Mage::helper('firegento_pdf')->__('Notes area')
        );
        $options = array();
        foreach ($positions as $k => $v) {
            $options[] = array(
                'value' => $k,
                'label' => $v
            );
        }
        return $options;
    }
}