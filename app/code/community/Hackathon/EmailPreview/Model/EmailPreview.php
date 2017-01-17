<?php

class Hackathon_EmailPreview_Model_EmailPreview
{
    /**
     * Returns the code of the rendered email.
     * 
     * @param int $templateId
     * @param array $templateParams
     * @return string
     */
    public function renderEmail($templateId, $templateParams)
    {
        $appEmulation = Mage::getSingleton('core/app_emulation');
        $store = $templateParams['store'];
        $storeId = $store->getStoreId();
        $initialEnvironmentInfo = $appEmulation->startEnvironmentEmulation($storeId);
        
        $template = Mage::getModel('core/email_template');

        if (is_numeric($templateId)) {
            $template->load($templateId);
        } else {
            $localeCode = Mage::getStoreConfig('general/locale/code', $storeId);
            $template->loadDefault($templateId, $localeCode);
        }
        
        /* @var $filter Mage_Core_Model_Input_Filter_MaliciousCode */
        $filter = Mage::getSingleton('core/input_filter_maliciousCode');

        $template->setTemplateText(
            $filter->filter($template->getTemplateText())
        );

        $templateProcessed = $template->getProcessedTemplate($templateParams, true);

        if ($template->isPlain()) {
            $templateProcessed = "<pre>" . htmlspecialchars($templateProcessed) . "</pre>";
        }
        
        // Stop store emulation process
        $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);
        
        return $templateProcessed;
    }
}
