<?php

class Hackathon_EmailPreview_Adminhtml_PreviewController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Check permissions
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/email_template');
    }

    /**
     * Show preview of a template specified by parameters
     */
    public function indexAction()
    {
        $this->loadLayout()
             ->renderLayout();
    }
}
