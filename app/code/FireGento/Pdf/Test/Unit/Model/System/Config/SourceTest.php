<?php

namespace FireGento\Pdf\Model\System\Config;

use Magento\Framework\Option\ArrayInterface;

abstract class SourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArrayInterface
     */
    protected $sourceModel;

    public function testImplementsArrayInterface()
    {
        $this->assertInstanceOf(
            ArrayInterface::class,
            $this->sourceModel
        );
    }
}
