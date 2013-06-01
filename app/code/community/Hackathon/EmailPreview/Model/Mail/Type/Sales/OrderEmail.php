<?php

class Hackathon_EmailPreview_Model_Mail_Type_Sales_OrderEmail extends Hackathon_EmailPreview_Model_Mail_Type_Sales_Abstract
{
    const TYPE_NEW = 'test_sales_order_email_template';
    const TYPE_UPDATE = 'test_sales_order_update_email_template';
    // Also works with guest template
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_Sales_NewOrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if ($observer->getEvent()->getData('templateType') !== self::TYPE_NEW &&
                $observer->getEvent()->getData('templateType') !== self::TYPE_UPDATE) {
            return $this;
        }
        
        $this->_prepareParams($observer, 'sales/order');
        
        return $this;
    }
}