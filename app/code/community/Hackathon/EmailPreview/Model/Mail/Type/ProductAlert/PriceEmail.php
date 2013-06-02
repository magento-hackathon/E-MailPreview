<?php

class Hackathon_EmailPreview_Model_Mail_Type_ProductAlert_PriceEmail extends Hackathon_EmailPreview_Model_Mail_Type_ProductAlert_Abstract
{
    const TYPE = 'test_product_price_alert_email_template';
    
    /**
     * @param int $storeId
     * @param int $customerGroupId
     * @return string
     */
    protected function _getBlockHtml($storeId, $customerGroupId)
    {
        $block = Mage::helper('productalert')->createBlock('productalert/email_price');
        $block->setStore($storeId)->reset();
        $product = Mage::getModel('catalog/product')->getCollection()->addPriceData()->getFirstItem();
        $product->setCustomerGroupId($customerGroupId);
        $productPrice = $product->getFinalPrice();
        $product->setFinalPrice(Mage::helper('tax')->getPrice($product, $productPrice));
        $product->setPrice(Mage::helper('tax')->getPrice($product, $product->getPrice()));
        $block->addProduct($product);
        
        return $block->toHtml();
    }
    
    /**
     * Returns the template type.
     * 
     * @return string
     */
    protected function _getType()
    {
        return self::TYPE;
    }
}
