<?php

class Hackathon_EmailPreview_Model_Data_Form extends Varien_Data_Form
{
    /**
     * Return allowed HTML form attributes
     * @return array
     */
    public function getHtmlAttributes()
    {
        return array('id', 'name', 'method', 'action', 'enctype', 'class', 'onsubmit', 'target');
    }
}
