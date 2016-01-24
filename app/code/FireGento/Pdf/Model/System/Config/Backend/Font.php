<?php

namespace FireGento\Pdf\Model\System\Config\Backend;

class Font extends \Magento\Config\Model\Config\Backend\File
{

    private $_allowedExtensions
        = array(
            'otf',
            'ttf',
        );

    /**
     * Returns the allowed font extensions.
     *
     * @return array containing the allowed font extensions
     */
    protected function _getAllowedExtensions()
    {
        return $this->_allowedExtensions;
    }
}