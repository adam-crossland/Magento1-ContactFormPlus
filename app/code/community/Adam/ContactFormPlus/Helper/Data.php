<?php
class Adam_ContactFormPlus_Helper_Data extends Mage_Core_Helper_Abstract{

	const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
	const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
	const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';

	public function getContactEmailRecipient($store = null){
		return Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT, $store);
	}

	public function getContactEmailSender($store = null){
		return Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER, $store);
	}

	public function getContactEmailTemplate($store = null){
		return Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE, $store);
	}
}