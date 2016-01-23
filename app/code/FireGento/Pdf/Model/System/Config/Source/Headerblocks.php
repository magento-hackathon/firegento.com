<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;


class Headerblocks implements ArrayInterface
{

    const LEFT = 'left';
    const RIGHT = 'right';

    /**
     * Return array of possible positions.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $positions = [
            self::LEFT  => __('Left'),
            self::RIGHT => __('Right'),
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
