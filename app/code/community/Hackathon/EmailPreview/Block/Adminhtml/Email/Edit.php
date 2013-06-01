<?php

class Hackathon_EmailPreview_Block_Adminhtml_Email_Edit
    extends Mage_Adminhtml_Block_System_Email_Template_Edit
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function getTabLabel()
    {
        return $this->helper("hackathon_emailpreview")->__("Edit Email");
    }

    public function getTabTitle()
    {
        return $this->helper("hackathon_emailpreview")->__("Edit Email");
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