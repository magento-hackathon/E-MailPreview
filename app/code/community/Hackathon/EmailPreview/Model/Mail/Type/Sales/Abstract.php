<?php

abstract class Hackathon_EmailPreview_Model_Mail_Type_Sales_Abstract
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
    
    /**
     * Prepare the parameters for the email
     * 
     * @param Varien_Event_Observer $observer
     * @param type $modelName
     * @param type $entityTemplateName
     * @return array($entity, $templateParams)
     */
    protected function _prepareParams(Varien_Event_Observer $observer, $modelName, $entityTemplateName = null)
    {
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        
        $incrementId = $requestParams['incrementId'];
        
        $entity = $this->_loadEntityByIncrementId($modelName, $incrementId);
        
        $order = $this->_loadOrderFrom($entity);
        
        $templateParams->setStoreId($order->getStore()->getStoreId());
        
        $templateParams->setOrder($order);
        $templateParams->setBilling($order->getBillingAddress());
        $paymentBlockHtml = $this->_getPaymentBlockHtmlFrom($order);
        $templateParams->setPaymentHtml($paymentBlockHtml);
        
        if (isset($requestParams['comment'])) {
            $templateParams->setComment($requestParams['comment']);
        }
        
        if (!empty($entityTemplateName)) {
            $templateParams->setData($entityTemplateName, $entity);
        }
        
        return array($entity, $templateParams);
    }
    
    /**
     * Load the the main email entity by its increment id
     */
    protected function _loadEntityByIncrementId($modelName, $incrementId)
    {
        return Mage::getModel($modelName)->load($incrementId, 'increment_id');
    }
    
    /**
     * Load the order from the main email entity
     */
    protected function _loadOrderFrom($entity)
    {
        if ($entity instanceof Mage_Sales_Model_Order) {
            return $entity;
        } else {
            return $entity->getOrder();
        }
    }
}
