<?php

namespace FireGento\Pdf\Model;

class Creditmemo
{

    /**
     * The actual PDF engine responsible for rendering the file.
     * @var \Magento\Sales\Model\Order\Pdf\AbstractPdf
     */
    private $_engine;

    /**
     * get pdf renderer engine
     *
     * @return \Magento\Sales\Model\Order\Pdf\AbstractPdf|\Magento\Sales\Model\Order\Pdf\Creditmemo
     */
    protected function getEngine()
    {
        if (!$this->_engine) {
            $modelClass = Mage::getStoreConfig('sales_pdf/creditmemo/engine');
            $engine = Mage::getModel($modelClass);

            if (!$engine) {
                // Fallback to Magento standard creditmemo layout.
                $engine = new \Magento\Sales\Model\Order\Pdf\Creditmemo();
            }

            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    /**
     * get pdf object
     *
     * @param  array|\Magento\Framework\Data\Collection $creditmemos creditmemos to render
     *
     * @return \Zend_Pdf
     */
    public function getPdf($creditmemos = array())
    {
        return $this->getEngine()->getPdf($creditmemos);
    }

}
