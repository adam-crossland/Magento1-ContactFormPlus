<?php
/**
 * Class Adam_ContactFormPlus_Model_Contact
 * @method int getId()
 * @method Adam_ContactFormPlus_Model_Contact setStoreId(int $storeId)
 * @method int getStoreId()
 * @method int getCreatedAt()
 * @method Adam_ContactFormPlus_Model_Contact setName(string $name)
 * @method string getName()
 * @method Adam_ContactFormPlus_Model_Contact setEmail(string $email)
 * @method string getEmail()
 * @method Adam_ContactFormPlus_Model_Contact setTelephone(string $telephone)
 * @method string getTelephone()
 * @method Adam_ContactFormPlus_Model_Contact setComment(string $comment)
 * @method string getComment()
 */
class Adam_ContactFormPlus_Model_Contact extends Mage_Core_Model_Abstract{

	protected function _construct(){
		$this->_init('adam_contact_form_plus/contact');
	}

	protected function setCreatedAt($timestamp){
		if(!$this->getCreatedAt()){
			$this->setData('created_at', $timestamp);
		}
		return $this;
	}

	protected function _beforeSave(){
		parent::_beforeSave();
		$this->setCreatedAt(Varien_Date::now());
		return $this;
	}
}