<?php
class Adam_ContactFormPlus_Block_Adminhtml_Contact_Container_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(){
        parent::__construct();
        $this->setId('contact_form_plus_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass(){
        return 'adam_contact_form_plus/contact_collection';
    }

    protected function _prepareCollection(){
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns(){

        $this->addColumn('contact_id', array(
            'header'=> Mage::helper('adam_contact_form_plus')->__('Contact Id'),
            'width' => '60px',
            'type'  => 'text',
            'index' => 'contact_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('adam_contact_form_plus')->__('Name'),
            'index' => 'name',
			'width' => '200px',
        ));

        $this->addColumn('email', array(
            'header' => Mage::helper('adam_contact_form_plus')->__('Email'),
            'index' => 'email',
			'width' => '200px',
        ));

		$this->addColumn('telephone', array(
			'header' => Mage::helper('adam_contact_form_plus')->__('Telephone'),
			'index' => 'telephone',
			'width' => '150px',
		));

		$this->addColumn('comment', array(
			'header' => Mage::helper('adam_contact_form_plus')->__('Comment'),
			'index' => 'comment',
			'type' => 'wrapline',
		));

		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header'    => Mage::helper('adam_contact_form_plus')->__('Submitted From (Store)'),
				'index'     => 'store_id',
				'type'      => 'store',
				'store_view'=> true,
				'display_deleted' => true,
				'width' => '200px',
			));
		}

		$this->addColumn('created_at', array(
			'header' => Mage::helper('adam_contact_form_plus')->__('Submitted At'),
			'index' => 'created_at',
			'type' => 'datetime',
			'width' => '100px',
		));

		$this->addColumn('action',
			array(
				'header'    => Mage::helper('adam_contact_form_plus')->__('Action'),
				'width'     => '100px',
				'type'      => 'action',
				'getter'     => 'getId',
				'actions'   => array(
					array(
						'caption' => Mage::helper('adam_contact_form_plus')->__('Re-Send'),
						'url'     => array('base'=>'*/*/resend'),
						'field'   => 'contact_id',
						'data-column' => 'action',
					),
					array(
						'caption' => Mage::helper('adam_contact_form_plus')->__('Delete'),
						'url'     => array('base'=>'*/*/delete'),
						'field'   => 'contact_id',
						'data-column' => 'action',
					),
				),
				'filter'    => false,
				'sortable'  => false,
				'index'     => 'stores',
				'is_system' => true,
			));

        return parent::_prepareColumns();
    }

	protected function _prepareMassaction(){
		$this->setMassactionIdField('contact_id');
		$this->getMassactionBlock()->setFormFieldName('contact_ids');
		$this->getMassactionBlock()->setUseSelectAll(true);

		$this->getMassactionBlock()->addItem('resend', array(
			'label'=> Mage::helper('adam_contact_form_plus')->__('Re-Send'),
			'url'  => $this->getUrl('*/*/resend'),
		));

		$this->getMassactionBlock()->addItem('delete', array(
			'label'=> Mage::helper('adam_contact_form_plus')->__('Delete'),
			'url'  => $this->getUrl('*/*/delete'),
			'confirm' => 'Are you sure?',
		));

		return $this;
	}

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

}
