<?php

class Hackathon_EmailPreview_Model_Mail_Type_ShareWishlistEmail
{
    const TYPE = 'test_share_wishlist_email_template';
    
    /**
     * @param Varien_Event_Observer $observer
     * @return Hackathon_EmailPreview_Model_Mail_Type_OrderEmail
     */
    public function hackathonEmailpreviewRenderEmailBefore(Varien_Event_Observer $observer)
    {
        if ($observer->getEvent()->getData('templateType') !== self::TYPE) {
            return $this;
        }
        
        // Create customer
        $templateParams = $observer->getEvent()->getData('templateParams');
        $requestParams = $templateParams->getRequestParams();
        $customerId = $requestParams['customerId'];
        $customer = Mage::getModel('customer/customer')->load($customerId);
        
        // Create wishlist
        $wishlistId = $requestParams['wishlistId'];
        $wishlist = Mage::getModel('wishlist/wishlist')->loadByCustomer($customer);
        
        /*
         * Create wishlist block. We add the wishlist to the registry because the block class (and its helper)
         * look at the registry in the first place.
         */
        $originalWishlist = Mage::registry('shared_wishlist');
        Mage::register('shared_wishlist', $wishlist, true);
        $wishlistBlock = Mage::getSingleton('core/layout')->createBlock('wishlist/share_email_items')->toHtml();
        Mage::register('shared_wishlist', $originalWishlist, true);
        
        // Create add all link
        $addAllLink = Mage::getUrl('wishlist/shared/allcart', array('code' => $wishlist->getSharingCode()));
        
        // Create view on site link
        $viewOnSiteLink = Mage::getUrl('wishlist/shared/index', array('code' => $wishlist->getSharingCode()));
        
        $templateParams = $observer->getEvent()->getData('templateParams');
        $templateParams->setCustomer($customer);
        $templateParams->setSalable($wishlist->isSalable() ? 'yes' : '');
        $templateParams->setItems($wishlistBlock);
        $templateParams->setMessage(Mage::helper('hackathon_emailpreview')->__('[yourmessage]'));
        $templateParams->setData('addAllLink', $addAllLink);
        $templateParams->setData('viewOnSiteLink', $viewOnSiteLink);
        
        return $this;
    }
}
