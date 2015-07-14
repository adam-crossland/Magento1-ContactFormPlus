<?php
class Adam_ContactFormPlus_Model_Resource_Contact_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected function _construct(){
		$this->_init('adam_contact_form_plus/contact');
	}
}