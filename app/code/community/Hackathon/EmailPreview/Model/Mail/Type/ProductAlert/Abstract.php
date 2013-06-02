<?php

abstract class Hackathon_EmailPreview_Model_Mail_Type_ProductAlert_Abstract
{
    /**
     * @param int $storeId
     * @param int $customerGroupId
     * @return string
     */
    abstract protected function _getBlockHtml($storeId, $customerGroupId);
    
    /**
     * Returns the template type.
     * 
     * @return string
     */
    abstract protected function _getType();
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if ($observer->getEvent()->getData('templateType') !== $this->_getType()) {
            return $this;
        }
        
        // Create customer
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        $customerId = $requestParams['customerId'];
        $customer = Mage::getModel('customer/customer')->load($customerId);
        $customerName = $customer->getName();
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $templateParams->setData('customerName', $customerName);
        $templateParams->setData('alertGrid', $this->_getBlockHtml($templateParams->getStoreId(), $customer->getGroupId()));
        
        return $this;
    } 
}
