<?php

namespace FireGento\Pdf\Model\System\Config\Source\Customer;

use Magento\Framework\Option\ArrayInterface;

class Number implements ArrayInterface
{

    /**
     * Databasefield name for customers increment_id
     */
    const CUSTOMER_NUMBER_FIELD_INCREMENT_ID = 'increment_id';
    /**
     * Return array of possible positions.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $selectOptions = array(
            '' => Mage::helper('firegento_pdf')->__('Standard (entity_id)'),
            self::CUSTOMER_NUMBER_FIELD_INCREMENT_ID => Mage::helper('firegento_pdf')->__('Customer Increment ID (increment_id)')
        );
        $options = array();
        foreach ($selectOptions as $k => $v) {
            $options[] = array(
                'value' => $k,
                'label' => $v
            );
        }
        return $options;
    }
}