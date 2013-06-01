<?php

class Hackathon_EmailPreview_Model_Source_Testtypes extends Varien_Object
{
    const XML_PATH_TESTTYPES = 'global/email/testtypes/';

    public function toOptionArray()
    {
        $templateLabelNode = Mage::app()->getConfig()->getNode(self::XML_PATH_TESTTYPES);

        return $templateLabelNode;
    }

}