<?php

class Hackathon_EmailPreview_Model_Mail_Type_SalesAbstract
{
    /**
     * @param Mage_Sales_Model_Order $order
     * @return string
     */
    protected function _getPaymentBlockHtmlFrom(Mage_Sales_Model_Order $order)
    {
        $storeId = $order->getStore()->getStoreId();
        
        try {
            // Retrieve specified view block from appropriate design package (depends on emulated store)
            $paymentBlock = Mage::helper('payment')->getInfoBlock($order->getPayment())
                ->setIsSecureMode(true);
            $paymentBlock->getMethod()->setStore($storeId);
            $paymentBlockHtml = $paymentBlock->toHtml();
        } catch (Exception $exception) {
            throw $exception;
        }

        return $paymentBlockHtml;
    }
}
