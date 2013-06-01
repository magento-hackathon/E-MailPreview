<?php

class Hackathon_EmailPreview_Model_Mail_Type_TokenStatusChangeEmail
{
    const TYPE = 'test_token_status_change_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if ($observer->getEvent()->getData('templateType') !== self::TYPE) {
            return $this;
        }
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $templateParams->setName(Mage::helper('hackathon_emailpreview')->__('[yourname]'));
        $templateParams->setData('userName', Mage::helper('hackathon_emailpreview')->__('[yourname]'));
        $templateParams->setEmail(Mage::helper('hackathon_emailpreview')->__('[email@example.com]'));
        $templateParams->setData('applicationName', Mage::helper('hackathon_emailpreview')->__('[application_name]'));
        $templateParams->setStatus(Mage::helper('hackathon_emailpreview')->__('[status]'));
        
        return $this;
    }
}
