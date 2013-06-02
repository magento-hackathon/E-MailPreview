<?php

class Hackathon_EmailPreview_Model_Source_Testtypes extends Varien_Object
{
    const XML_PATH_TESTTYPES = 'global/email/testtypes';

    public function toOptionArray()
    {
        $templateLabelNode = Mage::app()->getConfig()->getNode(self::XML_PATH_TESTTYPES)->children();
        
        $options = array();
        
        foreach ($templateLabelNode as $node) {
            $options[(string) $node->type] = (string) $node->name;
        }

        asort($options);

        return $options;
    }

}