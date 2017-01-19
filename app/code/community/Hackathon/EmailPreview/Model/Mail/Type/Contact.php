<?php

class Hackathon_EmailPreview_Model_Mail_Type_Contact
{
    const TYPE_CONTACT = 'test_contact_email_template';
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), 
            array(self::TYPE_CONTACT))) {
            return $this;
        }

        //@todo change logic here
        $templateParams = $observer->getEvent()->getData('templateParams');

        return $this;
    }
}
