<?php
class Adam_ContactFormPlus_Block_Adminhtml_Contact_Container extends Mage_Adminhtml_Block_Widget_Container
{
    public function __construct()
    {
        $this->_controller = 'adam_contact_form_plus';
        $this->_headerText = Mage::helper('adam_contact_form_plus')->__('Contacts');
        parent::__construct();
		$this->setTemplate('widget/grid/container.phtml');
    }

	protected $_addButtonLabel;
	protected $_backButtonLabel;
	protected $_blockGroup = 'adminhtml';

	public function getGridHtml(){
		return $this->getChildHtml('contact_grid');
	}

	public function getHeaderCssClass()
	{
		return 'icon-head ' . parent::getHeaderCssClass();
	}

	public function getHeaderWidth()
	{
		return 'width:50%;';
	}
}
