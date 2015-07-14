<?php
class Adam_ContactFormPlus_Adminhtml_ContactsController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction(){
        $this->loadLayout()
            ->_setActiveMenu('customer/adam_contact_form_plus')
            ->_addBreadcrumb($this->__('Customer'), $this->__('Customer'))
            ->_addBreadcrumb($this->__('Contacts'), $this->__('Contacts'));
        return $this;
    }

    public function indexAction(){
        $this->_title($this->__('Customer'))->_title($this->__('Contacts'));
        $this->_initAction()->renderLayout();
    }

    public function gridAction(){
        $this->loadLayout(false);
       	$this->renderLayout();
    }

	public function deleteAction(){
		$contact_id = $this->getRequest()->getParam('contact_id', false);
		if(!$contact_id){
			$contact_ids = $this->getRequest()->getParam('contact_ids', array());
			if(empty($contact_ids)){
				return $this->_redirect('*/*/index');
			}
		}else{
			$contact_ids = array($contact_id);
		}

		$this->delete($contact_ids);
		return $this->_redirect('*/*/index');
	}

	private function delete(array $ids){
		$failedToLoad = array();
		$failedToDelete = array();
		$successfullyDeleted = array();

		foreach($ids as $id){
			/* @var $contact Adam_ContactFormPlus_Model_Contact */
			$contact = Mage::getModel('adam_contact_form_plus/contact')->load($id);
			if(!$contact->getId()){
				$failedToLoad[] = $id;
				continue;
			}

			try{
				$contact->delete();
			}catch(Exception $e){
				$failedToDelete[] = $id;
				continue;
			}

			$successfullyDeleted[] = $id;
		}

		if($count = count($failedToLoad)){
			$this->_getSession()->addError($this->__('Failed to load %s Contact(s)', $count));
		}

		if($count = count($failedToDelete)){
			$this->_getSession()->addError($this->__('Failed to delete %s Contact(s)', $count));
		}

		if($count = count($successfullyDeleted)){
			$this->_getSession()->addSuccess($this->__('Successfully deleted %s Contact(s)', $count));
		}
	}

	public function resendAction(){
		$contact_id = $this->getRequest()->getParam('contact_id', false);
		if(!$contact_id){
			$contact_ids = $this->getRequest()->getParam('contact_ids', array());
			if(empty($contact_ids)){
				return $this->_redirect('*/*/index');
			}
		}else{
			$contact_ids = array($contact_id);
		}

		$this->send($contact_ids);
		return $this->_redirect('*/*/index');
	}

	private function send(array $ids){
		/* @var $helper Adam_ContactFormPlus_Helper_Data */
		$helper = Mage::helper('adam_contact_form_plus');
		$failedToLoad = array();
		$failedToSend = array();
		$sentSuccessfully = array();

		foreach($ids as $id){

			/* @var $contact Adam_ContactFormPlus_Model_Contact */
			$contact = Mage::getModel('adam_contact_form_plus/contact')->load($id);
			if(!$contact->getId()){
				$failedToLoad[] = $id;
				continue;
			}

			$mailTemplate = Mage::getModel('core/email_template');
			/* @var $mailTemplate Mage_Core_Model_Email_Template */
			$mailTemplate->setDesignConfig(array('area' => 'frontend'))
				->setReplyTo($contact->getEmail())
				->sendTransactional(
					$helper->getContactEmailTemplate($contact->getStoreId()),
					$helper->getContactEmailSender($contact->getStoreId()),
					$helper->getContactEmailRecipient($contact->getStoreId()),
					null,
					array('data' => $contact)
				);

			if(!$mailTemplate->getSentSuccess()){
				$failedToSend[] = $id;
			}else{
				$sentSuccessfully[] = $id;
			}
		}

		if($count = count($failedToLoad)){
			$this->_getSession()->addError($this->__('Failed to load %s Contact(s)', $count));
		}

		if($count = count($failedToSend)){
			$this->_getSession()->addError($this->__('Failed to send %s Contact(s)', $count));
		}

		if($count = count($sentSuccessfully)){
			$this->_getSession()->addSuccess($this->__('Successfully re-sent %s Contact(s)', $count));
		}
	}
}
