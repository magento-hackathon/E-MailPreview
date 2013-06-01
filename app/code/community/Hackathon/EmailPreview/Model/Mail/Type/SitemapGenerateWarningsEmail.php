<?php

class Hackathon_EmailPreview_Model_Mail_Type_SitemapGenerateWarningsEmail
{
    const TYPE = 'test_sitemap_generate_warnings_email_template';
    
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
        $templateParams->setWarnings(Mage::helper('hackathon_emailpreview')->__('[error 1]') . "\n" . Mage::helper('hackathon_emailpreview')->__('[error 2]'));
        
        return $this;
    }
}
