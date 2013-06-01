<?php
class Hackathon_EmailPreview_IndexController extends Mage_Core_Controller_Front_Action
{
    public function testAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}