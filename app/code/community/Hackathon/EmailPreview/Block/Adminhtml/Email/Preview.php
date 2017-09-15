<?php

class Hackathon_EmailPreview_Block_Adminhtml_Email_Preview
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    const TEST_TYPE_PER_DATABASE_TEMPLATE = 'database';
    const TEST_TYPE_PER_USED_TEMPLATE = 'used';

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
        $form = new Hackathon_EmailPreview_Model_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/preview/index'),
                'method' => 'post',
                'target' => '_blank'
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        $helper = Mage::helper('hackathon_emailpreview');
        $fieldset = $form->addFieldset('display', array(
            'legend' => $helper->__('Preview with Data'),
            'class' => 'entry-edit-head',
        ));

        $this->_addSpecificFields($fieldset, $helper);

        $this->_addCommonFields($fieldset, $helper);

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

    /**
     * @param $fieldset
     * @param $helper
     */
    protected function _addCommonFields($fieldset, $helper)
    {
        $fieldset->addField('incrementId', 'text', array(
            'name' => 'incrementId',
            'label' => $helper->__('Increment ID'),
        ));

        $fieldset->addField('userId', 'text', array(
            'name' => 'userId',
            'label' => $helper->__('User ID'),
        ));

        $fieldset->addField('customerId', 'text', array(
            'name' => 'customerId',
            'label' => $helper->__('Customer ID'),
        ));

        $fieldset->addField('storeId', 'select', array(
            'name' => 'storeId',
            'label' => $helper->__('Store ID'),
            'title' => $helper->__('Store ID'),
            'values' => Mage::getModel('adminhtml/system_config_source_store')->toOptionArray(),
        ));

        $fieldset->addField('comment', 'text', array(
            'name' => 'comment',
            'label' => $helper->__('Comment'),
        ));

        $fieldset->addField('fromName', 'text', array(
            'name' => 'fromName',
            'label' => $helper->__('From Name'),
        ));

        $fieldset->addField('fromEmail', 'text', array(
            'name' => 'fromEmail',
            'label' => $helper->__('From Email'),
        ));

        $fieldset->addField('fromTelephone', 'text', array(
            'name' => 'fromTelephone',
            'label' => $helper->__('From Telephone'),
        ));

        $fieldset->addField('toName', 'text', array(
            'name' => 'toName',
            'label' => $helper->__('To Name'),
        ));

        $fieldset->addField('toEmail', 'text', array(
            'name' => 'toEmail',
            'label' => $helper->__('To Email'),
        ));

        $fieldset->addField('message', 'text', array(
            'name' => 'message',
            'label' => $helper->__('Message'),
        ));

        $fieldset->addField('productSku', 'text', array(
            'name' => 'productSku',
            'label' => $helper->__('Product SKU'),
        ));

        $fieldset->addField('wishlistId', 'text', array(
            'name' => 'wishlistId',
            'label' => $helper->__('Wishlist ID'),
        ));
    }

    /**
     * @param $fieldset
     * @param $helper
     */
    protected function _addSpecificFields($fieldset, $helper)
    {

        $fieldset->addField('testType', 'hidden', array(
            'name' => 'testType',
            'value' => self::TEST_TYPE_PER_DATABASE_TEMPLATE
        ));

        $templateId = Mage::app()->getRequest()->getParam('id', false);

        $fieldset->addField('templateId', 'hidden', array(
            'name' => 'templateId',
            'value' => $templateId
        ));

        $fieldset->addField('templateType', 'select', array(
            'name' => 'templateType',
            'options' => Mage::getModel('hackathon_emailpreview/source_testtypes')->toOptionArray(),
            'label' => $helper->__('Template Type'),
        ));
    }

}
