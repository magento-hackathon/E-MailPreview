<?php

class Hackathon_EmailPreview_Block_Adminhtml_Tool
    extends Hackathon_EmailPreview_Block_Adminhtml_Email_Preview
{

    protected function _addSpecificFields(Varien_Data_Form_Element_Fieldset $fieldset, Hackathon_EmailPreview_Helper_Data $helper)
    {
        $fieldset->addField('testType', 'hidden', array(
            'name' => 'testType',
            'value' => self::TEST_TYPE_PER_USED_TEMPLATE
        ));

        $fieldset->addField('testRecipient', 'text', array(
            'name' => 'testRecipient',
            'label' => $helper->__('Test Recipient'),
        ));

        $templateTypeField = $fieldset->addField('templateType', 'select', array(
            'name' => 'templateType',
            'options' => Mage::getModel('hackathon_emailpreview/source_templatetypes')->toOptionArray(),
            'label' => $helper->__('Template Type'),
        ));

        return $templateTypeField;
    }
}
