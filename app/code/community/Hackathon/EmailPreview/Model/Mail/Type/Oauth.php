<?php

class Hackathon_EmailPreview_Model_Mail_Type_Oauth
{
    const TYPE_OAUTH = 'test_oauth_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_Oauth
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (self::TYPE_OAUTH !== $observer->getEvent()->getData('templateType')) {
            return $this;
        }

        $templateParams = $observer->getEvent()->getData('templateParams');
        $templateParams->setUserName('[username]');
        $templateParams->setApplicationName('[application name]');
        $templateParams->setStatus('[status]');

        return $this;
    }
}
