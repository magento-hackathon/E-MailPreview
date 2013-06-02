<?php
class Hackathon_EmailPreview_Block_Adminhtml_Email_PreviewContent extends Mage_Adminhtml_Block_Widget
{
    /**
     * Prepare html output
     *
     * @return string
     */
    protected function _toHtml()
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
        
        $html = $previewModel->renderEmail($templateId, $templateParams->getData());
        
        return $html;
    }
}
