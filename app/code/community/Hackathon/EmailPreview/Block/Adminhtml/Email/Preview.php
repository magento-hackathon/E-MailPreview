<?php

class Hackathon_EmailPreview_Block_Adminhtml_Email_Preview
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        $this->_blockGroup = 'hackathon_emailpreview';
        $this->_controller = 'adminhtml_form';
        $this->_headerText = Mage::helper('hackathon_emailpreview')->__('Edit Form');

        parent::__construct();

        self::_prepareForm();
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/preview/index'),
                'method' => 'post',
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        $helper = Mage::helper('hackathon_emailpreview');
        $fieldset = $form->addFieldset('display', array(
            'legend' => $helper->__('Preview with Data'),
            'class' => 'entry-edit-head',
        ));

        $fieldset->addField('previewtype', 'select', array(
            'name' => 'previewtype',
            'options' => Mage::getModel('hackathon_emailpreview/source_testtypes')->toOptionArray(),
            'label' => $helper->__('Preview Type'),
        ));

        $fieldset->addField('incrementId', 'text', array(
            'name' => 'incrementid',
            'label' => $helper->__('Increment ID'),
        ));

        $fieldset->addField('customerId', 'text', array(
            'name' => 'customerid',
            'label' => $helper->__('Customer ID'),
        ));

        $fieldset->addField('storeId', 'text', array(
            'name' => 'storeid',
            'label' => $helper->__('Store ID'),
        ));

        $fieldset->addField('comment', 'text', array(
            'name' => 'comment',
            'label' => $helper->__('Comment'),
        ));

        $fieldset->addField('fromName', 'text', array(
            'name' => 'fromname',
            'label' => $helper->__('From Name'),
        ));

        $fieldset->addField('fromEmail', 'text', array(
            'name' => 'fromemail',
            'label' => $helper->__('From Email'),
        ));

        $fieldset->addField('toName', 'text', array(
            'name' => 'toname',
            'label' => $helper->__('To Name'),
        ));

        $fieldset->addField('toEmail', 'text', array(
            'name' => 'toemail',
            'label' => $helper->__('To Email'),
        ));

        $fieldset->addField('message', 'text', array(
            'name' => 'message',
            'label' => $helper->__('Message'),
        ));
        $fieldset->addField('productSku', 'text', array(
            'name' => 'productsku',
            'label' => $helper->__('Product SKU'),
        ));
        $fieldset->addField('wishlistId', 'text', array(
            'name' => 'wishlistid',
            'label' => $helper->__('Wishlist ID'),
        ));

        $fieldset->addField('previewbutton', 'submit', array(
            'name' => 'previewbutton',
            'class' => 'scalable form-button',
            'value' => $helper->__('Preview with Data'),
        ));

        if (Mage::registry('hackathon_emailpreview')) {
            $form->setValues(Mage::registry('hackathon_emailpreview')->getData());
        }

        return parent::_prepareForm();
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