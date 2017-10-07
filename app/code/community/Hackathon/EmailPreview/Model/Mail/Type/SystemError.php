<?php

class Hackathon_EmailPreview_Model_Mail_Type_SystemError
{
    const TYPE_SYSTEM_ERROR = 'test_system_error_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_SystemError
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (self::TYPE_SYSTEM_ERROR !== $observer->getEvent()->getData('templateType')) {
            return $this;
        }

        $templateParams = $observer->getEvent()->getData('templateParams');
        $templateParams->setWarnings('[warnings]');

        return $this;
    }
}
