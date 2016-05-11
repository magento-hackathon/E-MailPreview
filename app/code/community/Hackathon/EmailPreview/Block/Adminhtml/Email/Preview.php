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

        $templateId = Mage::app()->getRequest()->getParam('id', false);
        $fieldset->addField('templateId', 'hidden', array(
            'name' => 'templateId',
            'label' => $helper->__('Template Type'),
            'value' => $templateId
        ));

        $templateTypeField = $fieldset->addField('templateType', 'select', array(
            'name' => 'templateType',
            'options' => Mage::getModel('hackathon_emailpreview/source_testtypes')->toOptionArray(),
            'label' => $helper->__('Template Type'),
        ));

        $entityTemplateName = 'invoice';
        $incrementFields[$entityTemplateName] = $fieldset->addField("{$entityTemplateName}IncrementId", 'select', array(
            'name' => "{$entityTemplateName}IncrementId",
            'label' => $helper->__('Increment ID'),
            'values'    => $this->modelOptions('sales/order_invoice', $entityTemplateName)
        ));

        $entityTemplateName = 'rma';
        $incrementFields[$entityTemplateName] = $this->addIncrementIdField($fieldset, $entityTemplateName, $helper, 'enterprise_rma/rma');

        $entityTemplateName = 'creditmemo';
        $incrementFields[$entityTemplateName] = $this->addIncrementIdField($fieldset, $entityTemplateName, $helper, 'sales/order_creditmemo');

        $entityTemplateName = 'order';
        $incrementFields[$entityTemplateName] = $this->addIncrementIdField($fieldset, $entityTemplateName, $helper, 'sales/order');

        $entityTemplateName = 'shipment';
        $incrementFields[$entityTemplateName] = $this->addIncrementIdField($fieldset, $entityTemplateName, $helper, 'sales/order_shipment');


        $fieldset->addField('customerId', 'select', array(
            'name' => 'customerId',
            'label' => $helper->__('Customer ID'),
            'values'    => array_map(function($customer){
                return [
                    'value'=>$customer['entity_id'],
                    'label'=>"{$customer['email']} ({$customer['entity_id']})",
                ];
            }, Mage::getModel('customer/customer')->getCollection()->setPageSize(100)->setCurPage(1)->getData()),
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

        $fieldset->addField('previewbutton', 'submit', array(
            'name' => 'previewbutton',
            'class' => 'scalable form-button',
            'value' => $helper->__('Preview with Data'),
        ));
        $this->setChild('form_after', Mage::app()->getLayout()
            ->createBlock('adminhtml/widget_form_element_dependence')
            ->addFieldMap($templateTypeField->getHtmlId(), $templateTypeField->getName())
            ->addFieldMap($incrementFields['invoice']->getHtmlId(), $incrementFields['invoice']->getName())
            ->addFieldMap($incrementFields['rma']->getHtmlId(), $incrementFields['rma']->getName())
            ->addFieldMap($incrementFields['creditmemo']->getHtmlId(), $incrementFields['creditmemo']->getName())
            ->addFieldMap($incrementFields['order']->getHtmlId(), $incrementFields['order']->getName())
            ->addFieldMap($incrementFields['shipment']->getHtmlId(), $incrementFields['shipment']->getName())
            ->addFieldDependence(
                $incrementFields['invoice']->getName(),
                $templateTypeField->getName(),
                'test_sales_order_invoice_email_template'
            )
            ->addFieldDependence(
                $incrementFields['rma']->getName(),
                $templateTypeField->getName(),
                'test_rma_new_email_template'
            )
            ->addFieldDependence(
                $incrementFields['creditmemo']->getName(),
                $templateTypeField->getName(),
                'test_sales_order_creditmemo_email_template'
            )
            ->addFieldDependence(
                $incrementFields['order']->getName(),
                $templateTypeField->getName(),
                'test_sales_order_email_template'
            )
            ->addFieldDependence(
                $incrementFields['shipment']->getName(),
                $templateTypeField->getName(),
                'test_sales_order_shipment_email_template'
            )
        );
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
     * @param string $model
     * @param $entityTemplateName
     * @return array
     */
    protected function modelOptions($model = "", $entityTemplateName)
    {
        if ($mageModel = Mage::getModel($model)):
            return array_map(function ($collectionItem, $entityTemplateName) use ($entityTemplateName) {
                $entityType = ucfirst($entityTemplateName);
                return [
                    'value' => $collectionItem['increment_id'],
                    'label' => "$entityType #{$collectionItem['increment_id']}",
                ];
            }, $mageModel->getCollection()->setPageSize(100)->setCurPage(1)->getData());
        else:
            return [
                'value' => null,
                'label' => Mage::helper('hackathon_emailpreview')->__('Could not access increment IDs for this data type.'),
            ];
        endif;
    }

    /**
     * @param $fieldset
     * @param $entityTemplateName
     * @param $helper
     * @param $model
     * @return mixed
     */
    protected function addIncrementIdField($fieldset, $entityTemplateName, $helper, $model)
    {
        return $fieldset->addField("{$entityTemplateName}IncrementId", 'select', array(
            'name' => "{$entityTemplateName}IncrementId",
            'label' => $helper->__('Increment ID'),
            'values' => $this->modelOptions($model, $entityTemplateName),
        ));
    }

}
