<?php

class Hackathon_EmailPreview_Model_Mail_Type_Newsletter
{
    const TYPE_NEWSLETTER_CONFIRM = 'test_newsleter_subscribe_email_template';
    const TYPE_NEWSLETTER_SUBSCRIBE_SUCCESS = 'test_newsletter_subscribe_success_email_template';
    const TYPE_NEWSLETTER_UNSUBSCRIBE_SUCCESS = 'test_newsletter_unsubscribe_success_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), 
            array(self::TYPE_NEWSLETTER_CONFIRM, 
                self::TYPE_NEWSLETTER_SUBSCRIBE_SUCCESS,
                self::TYPE_NEWSLETTER_UNSUBSCRIBE_SUCCESS))) {
            return $this;
        }
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $subscriber = Mage::getModel('newsletter/subscriber');
        $templateParams->setSubscriber($subscriber);

        return $this;
    }
}
