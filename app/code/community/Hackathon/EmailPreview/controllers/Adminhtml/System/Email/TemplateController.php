<?php

require_once('Mage/Adminhtml/controllers/System/Email/TemplateController.php');

class Hackathon_EmailPreview_Adminhtml_System_Email_TemplateController
    extends Mage_Adminhtml_System_Email_TemplateController
{

    /**
     * Edit transactional email action
     * override fcuntion to _NOT_ load the Block adminhtml/system_email_template_edit before rendering
     */
    public function editAction()
    {
        $this->loadLayout();
        $template = $this->_initTemplate('id');
        $this->_setActiveMenu('system/email_template');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Transactional Emails'), Mage::helper('adminhtml')->__('Transactional Emails'), $this->getUrl('*/*'));

        if ($this->getRequest()->getParam('id')) {
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Edit Template'), Mage::helper('adminhtml')->__('Edit System Template'));
        } else {
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('New Template'), Mage::helper('adminhtml')->__('New System Template'));
        }

        $this->_title($template->getId() ? $template->getTemplateCode() : $this->__('New Template'));

        /*
        $this->_addContent($this->getLayout()->createBlock('adminhtml/system_email_template_edit', 'template_edit')
            ->setEditMode((bool)$this->getRequest()->getParam('id')));
        */

        $this->renderLayout();
    }

}