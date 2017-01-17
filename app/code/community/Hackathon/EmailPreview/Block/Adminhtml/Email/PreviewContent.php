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
        $storeId = $this->getRequest()->getParam('storeId');
        $appEmulation = Mage::getSingleton('core/app_emulation');
        $initialEnvironmentInfo = $appEmulation->startEnvironmentEmulation($storeId);
        Mage::app()->getTranslator()->init('frontend', true);

        $previewModel = Mage::getModel('hackathon_emailpreview/emailPreview');

        $templateId = $this->getRequest()->getParam('templateId');
        $templateType = $this->getRequest()->getParam('templateType');

        $templateParams = new Varien_Object();
        $templateParams->setRequestParams($this->getRequest()->getParams());
        $templateParams->setStoreId($storeId);

        if($this->getRequest()->getParam('useLocale')) {
            $templateId = $this->_getHelper()->getRealTemplateType($templateType);
        }

        $eventData = array(
            'templateParams' => $templateParams,
            'templateType' => $templateType
        );

        Mage::dispatchEvent('hackathon_emailpreview_render_email_before', $eventData);

        $storeId = $templateParams->getStoreId();
        $templateParams->setStore(Mage::app()->getStore($storeId));

        $html = $previewModel->renderEmail($templateId, $templateParams->getData());

        Mage::app()->getTranslator()->init('frontend', false);
        $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);

        return $html;
    }

    /**
     * @return Hackathon_EmailPreview_Helper_Data|Mage_Core_Helper_Abstract
     */
    protected function _getHelper() {
        return Mage::helper('hackathon_emailpreview');
    }
}
