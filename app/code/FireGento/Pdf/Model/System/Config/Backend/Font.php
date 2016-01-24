<?php

namespace FireGento\Pdf\Model\System\Config\Backend;

use Magento\Config\Model\Config\Backend\File;


class Font extends File
{

    private $_allowedExtensions = array(
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
