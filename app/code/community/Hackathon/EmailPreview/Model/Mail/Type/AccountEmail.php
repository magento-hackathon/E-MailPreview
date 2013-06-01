<?php

class Hackathon_EmailPreview_Model_Mail_Type_AccountEmail
{
    const TYPE_NEW_ACCOUNT = 'test_new_account_email_template';
    const TYPE_NEW_ACCOUNT_CONFIRMATION_KEY = 'test_new_account_confirmation_key_email_template';
    const TYPE_NEW_ACCOUNT_CONFIRMATED = 'test_new_account_confirmed_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), array(self::TYPE_NEW_ACCOUNT, self::TYPE_NEW_ACCOUNT_CONFIRMATION_KEY, self::TYPE_NEW_ACCOUNT_CONFIRMATED))) {
            return $this;
        }
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        $customerId = $requestParams['customerId'];
        $customer = Mage::getModel('customer/customer')->load($customerId);
        $customer->setPassword(Mage::helper('hackathon_emailpreview')->__('[yourpasswordhere]'));
        $templateParams->setCustomer($customer);
        $templateParams->setBackUrl('');

        return $this;
    }
}
