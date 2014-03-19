<?php

class Hackathon_EmailPreview_Model_Mail_Type_RmaNew extends Hackathon_EmailPreview_Model_Mail_Type_Sales_Abstract
{
    const TYPE_RMA_NEW = 'test_rma_new_email_template';
    const TYPE_RMA_AUTH = 'test_rma_auth_email_template';

    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_Sales_Abstract
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if (!in_array($observer->getEvent()->getData('templateType'), array(self::TYPE_RMA_NEW, self::TYPE_RMA_AUTH))) {
            return $this;
        }

        $this->_prepareParams($observer, 'enterprise_rma/rma');

        return $this;
    }
}
