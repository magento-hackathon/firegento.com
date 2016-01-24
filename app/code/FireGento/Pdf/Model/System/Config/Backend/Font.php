<?php

namespace FireGento\Pdf\Model\System\Config\Backend;

<<<<<<< HEAD
class Font extends \Magento\Config\Model\Config\Backend\File
{

    private $_allowedExtensions
        = array(
            'otf',
            'ttf',
        );
=======
use Magento\Config\Model\Config\Backend\File;


class Font extends File
{

    private $_allowedExtensions = array(
        'otf',
        'ttf',
      );
>>>>>>> 24c12c32097c00434df9b1b4f1957b3d9ab80ed2

    /**
     * Returns the allowed font extensions.
     *
     * @return array containing the allowed font extensions
     */
    protected function _getAllowedExtensions()
    {
        return $this->_allowedExtensions;
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 24c12c32097c00434df9b1b4f1957b3d9ab80ed2
