<?php

namespace FireGento\Pdf\Model;

class Observer
{
    /**
     * Add notes to invoice document.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    public function addInvoiceNotes(\Magento\Framework\Event\Observer $observer)
    {
        $this->_addShippingCountryNotes($observer);
        $this->_addInvoiceDateNotice($observer);
        $this->_addInvoiceMaturity($observer);
        $this->_addPaymentMethod($observer);
        $this->_addShippingMethod($observer);
        $this->_addInvoiceComments($observer);

        return $this;
    }

    /**
     * Add notes based on shipping country
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return $this
     */
    private function _addShippingCountryNotes(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();
        $shippingCountryNotes = Mage::helper('firegento_pdf/invoice')->getShippingCountryNotes($order);

        if (!empty($shippingCountryNotes)) {
            $result  = $observer->getResult();
            $notes   = $result->getNotes();
            $notes = array_merge($notes, $shippingCountryNotes);
            $result->setNotes($notes);
        }
        return $this;
    }

    /**
     * add invoice date notice to pdf
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return $this
     */
    private function _addInvoiceDateNotice(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/invoice/show_date_notice')) {
            return $this;
        }

        $result = $observer->getResult();
        $notes = $result->getNotes();
        $notes[] = Mage::helper('firegento_pdf')->__('Invoice date is equal to delivery date.');
        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add maturity to invoice notes.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addInvoiceMaturity(\Magento\Framework\Event\Observer $observer)
    {
        $result = $observer->getResult();
        $notes = $result->getNotes();

        $maturity = Mage::getStoreConfig('sales_pdf/invoice/maturity');
        if (!empty($maturity) || 0 < $maturity) {
            $maturity = Mage::helper('firegento_pdf')->__(
                'Invoice maturity: %s days', Mage::getStoreConfig('sales_pdf/invoice/maturity')
            );
        } elseif ('0' === $maturity) {
            $maturity = Mage::helper('firegento_pdf')->__('Invoice is payable immediately');
        }

        $notes[] = $maturity;
        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add payment method to invoice notes.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addPaymentMethod(\Magento\Framework\Event\Observer $observer)
    {
        if (Mage::getStoreConfig('sales_pdf/invoice/payment_method_position')
            != FireGento_Pdf_Model_System_Config_Source_Payment::POSITION_NOTE
        ) {
            return $this;
        }

        $result = $observer->getResult();
        $notes = $result->getNotes();
        $notes[] = Mage::helper('firegento_pdf')->__(
            'Payment method: %s', $observer->getOrder()->getPayment()->getMethodInstance()->getTitle()
        );
        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add shipping method to invoice notes.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addShippingMethod(\Magento\Framework\Event\Observer $observer)
    {
        $invoice = $observer->getInvoice();
        $shipment = $observer->getShipment();
        if (empty($invoice) && empty($shipment)
            || !empty($invoice) && Mage::getStoreConfig('sales_pdf/invoice/shipping_method_position')
            != FireGento_Pdf_Model_System_Config_Source_Shipping::POSITION_NOTE
            || !empty($shipment) && Mage::getStoreConfig('sales_pdf/shipment/shipping_method_position')
            != FireGento_Pdf_Model_System_Config_Source_Shipping::POSITION_NOTE
        ) {
            return $this;
        }

        $result = $observer->getResult();
        $notes = $result->getNotes();
        $notes[] = Mage::helper('firegento_pdf')->__(
            'Shipping method: %s', $observer->getOrder()->getShippingDescription()
        );
        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add the invoice comments
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addInvoiceComments(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/invoice/show_comments')) {
            return $this;
        }

        /** @var \Magento\Sales\Model\Order\Invoice $invoice */
        $invoice = $observer->getInvoice();

        /** @var \Magento\Sales\Model\ResourceModel\Order\Invoice\Comment\Collection $commentsCollection */
        $commentsCollection = $invoice->getCommentsCollection();
        $commentsCollection->addVisibleOnFrontFilter();

        $result = $observer->getResult();
        $notes = $result->getNotes();

        foreach ($commentsCollection as $comment) {
            /** @var $comment \Magento\Sales\Model\Order\Invoice\Comment */
            $notes[] = $comment->getComment();
        }

        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add notes to shipment document.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    public function addShipmentNotes(\Magento\Framework\Event\Observer $observer)
    {
        $this->_addShippingMethod($observer);
        $this->_addShipmentComments($observer);

        return $this;
    }

    /**
     * Add the shipment comments
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addShipmentComments(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/shipment/show_comments')) {
            return $this;
        }

        /** @var \Magento\Sales\Model\Order\Shipment $shipment */
        $shipment = $observer->getShipment();

        /** @var \Magento\Sales\Model\ResourceModel\Order\Shipment\Comment\Collection $commentsCollection */
        $commentsCollection = $shipment->getCommentsCollection();
        $commentsCollection->addVisibleOnFrontFilter();

        $result = $observer->getResult();
        $notes = $result->getNotes();

        foreach ($commentsCollection as $comment) {
            /** @var $comment \Magento\Sales\Model\Order\Shipment\Comment */
            $notes[] = $comment->getComment();
        }

        $result->setNotes($notes);
        return $this;
    }

    /**
     * Add notes to credit memo document.
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    public function addCreditmemoNotes(\Magento\Framework\Event\Observer $observer)
    {
        $this->_addCreditmemoComments($observer);

        return $this;
    }

    /**
     * Add the credit memo comments
     *
     * @param  \Magento\Framework\Event\Observer $observer observer object
     *
     * @return Observer
     */
    private function _addCreditmemoComments(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/creditmemo/show_comments')) {
            return $this;
        }

        /** @var \Magento\Sales\Model\Order\Creditmemo $creditmemo */
        $creditmemo = $observer->getCreditmemo();

        /** @var \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Comment\Collection $commentsCollection */
        $commentsCollection = $creditmemo->getCommentsCollection();
        $commentsCollection->addVisibleOnFrontFilter();

        $result = $observer->getResult();
        $notes = $result->getNotes();

        foreach ($commentsCollection as $comment) {
            /** @var $comment \Magento\Sales\Model\Order\Creditmemo\Comment */
            $notes[] = $comment->getComment();
        }

        $result->setNotes($notes);
        return $this;
    }

    /**
     * Adds a barcode representing the order number to the invoice if activated
     *
     * @param \Magento\Framework\Event\Observer $observer observer which is passed by magento
     *
     * @return Observer
     */
    public function addInvoiceBarcode(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/invoice/order_id_as_barcode')) {
            return $this;
        }

        return $this->_addBarcode($observer);
    }

    /**
     * Adds a barcode representing the order number to the shipment if activated
     *
     * @param \Magento\Framework\Event\Observer $observer observer which is passed by magento
     *
     * @return Observer
     */
    public function addShipmentBarcode(\Magento\Framework\Event\Observer $observer)
    {
        if (!Mage::getStoreConfigFlag('sales_pdf/shipment/order_id_as_barcode')) {
            return $this;
        }

        return $this->_addBarcode($observer);
    }

    /**
     * Adds a barcode representing the order number to a PDF
     *
     * @param  \Magento\Framework\Event\Observer $observer observer which is passed by magento
     *
     * @return Observer
     */
    private function _addBarcode(\Magento\Framework\Event\Observer $observer)
    {
        $page = $observer->getPage();
        $order = $observer->getOrder();

        $barcodeConfig = array(
            'drawText' => false,
            'orientation' => 90,
            'barHeight' => 25,
            'text' => $order->getIncrementId()
        );
        $rendererConfig = array(
            'verticalPosition' => 'top',
            'moduleSize' => 1
        );
        // create dummy Zend_Pdf object, which just stores the current page, so that we can pass it in
        // Zend_Barcode_Renderer_Pdf->setResource()
        $pdf = new \Zend_Pdf();
        $pdf->pages[] = $page;
        /** @var $renderer \Zend_Barcode_Renderer_Pdf */
        $renderer = \Zend_Barcode::factory('code128', 'pdf', $barcodeConfig, $rendererConfig)->setResource($pdf, 0);
        // calculate left offset so that barcode is printed on the right with a little margin
        $leftOffset = $page->getWidth() - $renderer->getBarcode()->getWidth(true) * $renderer->getModuleSize() - 10;
        $renderer->setLeftOffset($leftOffset);
        $renderer->setTopOffset(50);
        $renderer->draw();
        return $this;
    }
}
