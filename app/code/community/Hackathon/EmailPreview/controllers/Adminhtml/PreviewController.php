<?php
class Hackathon_EmailPreview_Adminhtml_PreviewController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Show preview of a template specified by parameters
     */
    public function indexAction()
    {
        $this->loadLayout()
             ->renderLayout();
    }
}