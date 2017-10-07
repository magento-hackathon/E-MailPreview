<?php

class Hackathon_EmailPreview_Model_Source_Templatetypes extends Varien_Object
{
    const XML_PATH_TEMPLATETYPES = 'global/email/templates';

    public function toOptionArray()
    {
        $templateLabelNode = Mage::app()->getConfig()->getNode(self::XML_PATH_TEMPLATETYPES)->children();
        
        $options = array();
        
        foreach ($templateLabelNode as $node) {
            $options[$node->getName()] = (string) $node->label;
        }

        asort($options);

        return $options;
    }

}