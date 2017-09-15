<?php

class Hackathon_EmailPreview_Model_Mail_Type_AdminPasswordEmail
{
    const TYPE_FORGOT_ADMIN_PASSWORD = 'test_forgot_admin_password_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), array(self::TYPE_FORGOT_ADMIN_PASSWORD))) {
            return $this;
        }

        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        $userId = $requestParams['userId'];
        $user = Mage::getModel('customer/customer')->load($userId);
        $user->setPassword(Mage::helper('hackathon_emailpreview')->__('[yourpasswordhere]'));
        $templateParams->setUser($user);

        return $this;
    }
}
