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

        if($this->getRequest()->getParam('testType') == Hackathon_EmailPreview_Block_Adminhtml_Email_Preview::TEST_TYPE_PER_DATABASE_TEMPLATE) {
            $templateId = $this->getRequest()->getParam('templateId');
            $templateType = $this->getRequest()->getParam('templateType');
        }
        else {
            $configNode = Mage::app()->getConfig()->getNode(
                Hackathon_EmailPreview_Model_Source_Templatetypes::XML_PATH_TEMPLATETYPES.'/'.$this->getRequest()->getParam('templateType'));

            $templateId = Mage::getStoreConfig((string) $configNode->configpath);

            $templateType =  (string) Mage::app()->getConfig()->getNode(
                Hackathon_EmailPreview_Model_Source_Testtypes::XML_PATH_TESTTYPES.'/'.$configNode->testtype.'/type');
        }

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

        $recipient = $this->getRequest()->getParam('testRecipient');

        $html = $previewModel->renderEmail($templateId, $templateParams->getData(), $recipient);

        Mage::app()->getTranslator()->init('frontend', false);
        $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);

        return $html;
    }
}
