<?php

namespace FireGento\Pdf\Model;

class Invoice
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
     * @return \Magento\Sales\Model\Order\Pdf\AbstractPdf|\Magento\Sales\Model\Order\Pdf\Invoice
     */
    protected function getEngine()
    {
        if (!$this->_engine) {
            $modelClass = Mage::getStoreConfig('sales_pdf/invoice/engine');
            $engine = Mage::getModel($modelClass);

            if (!$engine) {
                // Fallback to Magento standard invoice layout.
                $engine = new \Magento\Sales\Model\Order\Pdf\Invoice();
            }

            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    /**
     * get pdf for invoices
     *
     * @param  array|\Magento\Framework\Data\Collection $invoices invoices to render pdfs for
     *
     * @return mixed
     */
    public function getPdf($invoices = array())
    {
        return $this->getEngine()->getPdf($invoices);
    }

}
