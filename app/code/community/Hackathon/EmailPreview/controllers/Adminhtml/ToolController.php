<?php

/**
 * @author       Wilfried Wolf <wilfried.wolf@sandstein.de>
 * @copyright    Copyright (c) 2017 Sandstein Neue Medien GmbH
 *
 */
class Hackathon_EmailPreview_Adminhtml_ToolController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Start here to test the templates actually set in your shop
     */
    public function indexAction()
    {
        $this->_title($this->__('System'))->_title($this->__('Email Preview Tool'));

        $this->loadLayout();

        $this->_setActiveMenu('system/tools/hackathon_emailpreview');
        $this->_addContent($this->getLayout()->createBlock('hackathon_emailpreview/adminhtml_tool'));

        $this->renderLayout();
    }
}