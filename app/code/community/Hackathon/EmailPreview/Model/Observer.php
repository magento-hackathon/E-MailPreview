<?php
class Hackathon_EmailPreview_Model_Observer
{
    /*
    public function hookToControllerActionPreDispatch($observer)
    {
        //we compare action name to see if that's action for which we want to add our own event
        if($observer->getEvent()->getControllerAction()->getFullActionName() == 'adminhtml_system_email_template_edit')
        {
            //We are dispatching our own event before action ADD is run and sending parameters we need
            Mage::dispatchEvent("adminhtml_system_email_template_edit_before",
                array(
                    'request' => $observer->getControllerAction()->getRequest(),
                    'event' => $observer->getEvent()
                )
            );
        }
    }

    public function hookToControllerActionPostDispatch($observer)
    {
        //we compare action name to see if that's action for which we want to add our own event
        if($observer->getEvent()->getControllerAction()->getFullActionName() == 'adminhtml_system_email_template_edit')
        {
            //We are dispatching our own event before action ADD is run and sending parameters we need
            Mage::dispatchEvent("adminhtml_system_email_template_edit_after",
                array(
                    'request' => $observer->getControllerAction()->getRequest(),
                    'event' => $observer->getEvent()
                )
            );
        }
    }


    public function adminhtml_system_email_template_edit_before( $event )
    {
        $controller = $event->getEvent()->getControllerAction();

        $this->loadLayout();
        $template = $controller->_initTemplate('id');
        $controller->_setActiveMenu('system/email_template');
    */
//        $controller->_addBreadcrumb(Mage::helper('adminhtml')->__('Transactional Emails'), Mage::helper('adminhtml')->__('Transactional Emails'), $controller->getUrl('*/*'));
/*
        if ($controller->getRequest()->getParam('id')) {
            $controller->_addBreadcrumb(Mage::helper('adminhtml')->__('Edit Template'), Mage::helper('adminhtml')->__('Edit System Template'));
        } else {
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('New Template'), Mage::helper('adminhtml')->__('New System Template'));
        }

        $controller->_title($template->getId() ? $template->getTemplateCode() : $controller->__('New Template'));

//        $controller->_addContent($controller->getLayout()->createBlock('adminhtml/system_email_template_edit', 'template_edit')
//            ->setEditMode((bool)$controller->getRequest()->getParam('id')));

        $controller->renderLayout();

        $controller->getRequest()->setDispatched( true );
    }

    public function controllerActionLayoutRenderBefore()
    {
        Mage::app()->getLayout()->unsetBlock('template_edit');
       // Mage::app()->
    }
*/
}