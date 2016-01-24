<?php

namespace FireGento\Pdf\Model;

class Shipment
{

    /**
     * The actual PDF engine responsible for rendering the file.
     *
     * @var \Magento\Sales\Model\Order\Pdf\AbstractPdf
     */
    private $_engine;

    /**
     * get pdf rendering engine
     *
     * @return \Magento\Sales\Model\Order\Pdf\AbstractPdf|\Magento\Sales\Model\Order\Pdf\Shipment
     */
    protected function getEngine()
    {
        if (!$this->_engine) {
            $modelClass = Mage::getStoreConfig('sales_pdf/shipment/engine');
            $engine = Mage::getModel($modelClass);

            if (!$engine) {
                // Fallback to Magento standard shipment layout.
                $engine = new \Magento\Sales\Model\Order\Pdf\Shipment();
            }

            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    /**
     * get PDF object
     *
     * @param  array|\Magento\Framework\Data\Collection $shipments shipments to generate pdfs for
     *
     * @return mixed
     */
    public function getPdf($shipments = array())
    {
        return $this->getEngine()->getPdf($shipments);
    }

}
