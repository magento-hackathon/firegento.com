<?php

namespace FireGento\Pdf\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Logo implements ArrayInterface
{

    const LEFT = 'left';
    const CENTER = 'center';
    const RIGHT = 'right';
    const FULL_WIDTH = 'full_width';

    /**
     * Return array of possible positions.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $positions = [
            self::LEFT       => __('Left'),
            self::CENTER     => __('Center'),
            self::RIGHT      => __('Right'),
            self::FULL_WIDTH => __('Full width'),
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

