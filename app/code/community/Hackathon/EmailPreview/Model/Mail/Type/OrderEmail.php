<?php

class Hackathon_EmailPreview_Model_Mail_Type_OrderEmail extends Hackathon_EmailPreview_Model_Mail_Type_SalesAbstract
{
    const TYPE = 'test_sales_order_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if ($observer->getEvent()->getData('templateType') !== self::TYPE) {
            return $this;
        }
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        
        $orderId = $requestParams['orderId'];
        
        $order = Mage::getModel('sales/order')->load($orderId);
        
        $templateParams->setStoreId($order->getStore()->getStoreId());
        
        $templateParams->setOrder($order);
        $templateParams->setBilling($order->getBillingAddress());
        $paymentBlockHtml = $this->_getPaymentBlockHtmlFrom($order);
        $templateParams->setPaymentHtml($paymentBlockHtml);
        
        return $this;
    }
}
