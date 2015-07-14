<?php
class Adam_ContactFormPlus_Model_Observers_Mail{

	public function adam_contact_form_plus_mail_sent_successfully(Varien_Event_Observer $e){
		/* @var $postObject Varien_Object */
		$postObject = $e->getEvent()->getPostObject();

		/* @var $contact Adam_ContactFormPlus_Model_Contact */
		$contact = Mage::getModel('adam_contact_form_plus/contact');
		$contact->setStoreId(Mage::app()->getStore()->getId())
			->setName($postObject->getName())
			->setEmail($postObject->getEmail())
			->setTelephone($postObject->getTelephone())
			->setcomment($postObject->getComment())
			->save();
	}

}