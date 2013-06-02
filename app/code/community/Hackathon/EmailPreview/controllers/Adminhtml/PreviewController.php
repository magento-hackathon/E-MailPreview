<?php
class Hackathon_EmailPreview_Admminhtml_PreviewController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Show preview of a template specified by parameters
     */
    public function indexAction()
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