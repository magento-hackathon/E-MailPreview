<?php

class Hackathon_EmailPreview_Model_EmailPreview
{
    /**
     * Returns the code of the rendered email.
     * 
     * @param int $templateId
     * @param array $templateParams
     * @param array $recipient
     * @return string
     */
    public function renderEmail($templateId, $templateParams, $recipient = false)
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

        if($recipient) {

            $subject = $template->getProcessedTemplateSubject($templateParams);
            $this->_send($template, $subject, $templateProcessed, $recipient);
        }

        if ($template->isPlain()) {
            $templateProcessed = "<pre>" . htmlspecialchars($templateProcessed) . "</pre>";
        }
        
        // Stop store emulation process
        $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);
        
        return $templateProcessed;
    }

    protected function _send($template, $subject, $text, $email)
    {

        $emails = array($email);
        $names = array();

        ini_set('SMTP', Mage::getStoreConfig('system/smtp/host'));
        ini_set('smtp_port', Mage::getStoreConfig('system/smtp/port'));

        $mail = $template->getMail();

        foreach ($emails as $key => $email) {
            $mail->addTo($email, '=?utf-8?B?' . base64_encode($names[$key]) . '?=');
        }

        if ($template->isPlain()) {
            $mail->setBodyText($text);
        } else {
            $mail->setBodyHTML($text);
        }

        $mail->setSubject('=?utf-8?B?' . base64_encode($subject) . '?=');
        $mail->setFrom($template->getSenderEmail(), $template->getSenderName());

        try {
            $mail->send();
            $template->_mail = null;
        }
        catch (Exception $e) {
            $template->_mail = null;
            Mage::logException($e);
            return false;
        }

        return true;
    }
}
