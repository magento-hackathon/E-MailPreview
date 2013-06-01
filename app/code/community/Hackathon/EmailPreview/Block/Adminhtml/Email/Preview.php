<?php

class Hackathon_EmailPreview_Block_Adminhtml_Email_Preview
    extends Mage_Adminhtml_Block_System_Email_Template_Edit
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        parent::__construct();

        $this->setTemplate('hackathon/test.phtml');
    }

    public function getTabLabel()
    {
        return $this->helper("hackathon_emailpreview")->__("Preview Email");
    }

    public function getTabTitle()
    {
        return $this->helper("hackathon_emailpreview")->__("Preview Email");
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

}