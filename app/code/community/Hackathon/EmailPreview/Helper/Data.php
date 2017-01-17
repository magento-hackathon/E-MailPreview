<?php
class Hackathon_EmailPreview_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getRealTemplateType($testTemplateType) {

        switch($testTemplateType) {
            case 'test_new_account_email_template':
                return 'customer_create_account_email_template';
            default:
                return preg_replace('/^test_/','', $testTemplateType);
        }
    }
}