<?php
class Adam_ContactFormPlus_Model_Resource_Contact extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct(){
        $this->_init('adam_contact_form_plus/contact', 'contact_id');
    }
}