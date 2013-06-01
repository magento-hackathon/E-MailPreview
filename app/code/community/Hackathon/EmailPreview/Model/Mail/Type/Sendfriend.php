<?php

class Hackathon_EmailPreview_Model_Mail_Type_Sendfriend
{
    const TYPE_SENDFRIEND = 'test_sendfriend_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), array(self::TYPE_SENDFRIEND))) {
            return $this;
        }
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        $fromName = $requestParams['fromName'];
        $fromEmail = $requestParams['fromEmail'];
        $toName = $requestParams['toName'];
        $toEmail = $requestParams['toEmail'];
        $message = $requestParams['message'];
        $productSku = $requestParams['productSku'];
        $product = Mage::getModel('catalog/product')->loadByAttribute('sku', $productSku);
        $productName = $product->getName();
        $productUrl = $product->getUrlInStore();
        $productImage = Mage::helper('catalog/image')->init($product, 'small_image')->resize(75);
        $templateParams->setName($toName);
        $templateParams->setEmail($toEmail);
        $templateParams->setProductName($productName);
        $templateParams->setProductUrl($productUrl);
        $templateParams->setMessage($message);
        $templateParams->setSenderName($fromName);
        $templateParams->setData('sender_email', $fromEmail);
        $templateParams->setProductImage($productImage);
        
        return $this;
    }
}
