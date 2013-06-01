<?php

class Hackathon_EmailPreview_TestController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        $previewModel = Mage::getModel('hackathon_emailpreview/emailPreview');
        
        $storeId = $this->getRequest()->getParam('storeId');
        $templateId = $this->getRequest()->getParam('templateId');
        $templateType = $this->getRequest()->getParam('templateType');
        
        $templateParams = new Varien_Object();
        $templateParams->setRequestParams($this->getRequest()->getParams());
        $templateParams->setStoreId($storeId);
        
        $eventData = array(
            'templateParams' => $templateParams,
            'templateType' => $templateType
        );
        
        Mage::dispatchEvent('hackathon_emailpreview_render_email_before', $eventData);
        
        $storeId = $templateParams->getStoreId();
        $templateParams->setStore(Mage::app()->getStore($storeId));
        
        $previewModel->renderEmail($templateId, $templateParams->getData());
    }
}
