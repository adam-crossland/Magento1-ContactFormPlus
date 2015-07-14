<?php
/* @var $installer Mage_Sales_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
/**
 * Contact Entity Table
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('adam_contact_form_plus/contact'))
    ->addColumn('contact_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'contact ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Store id, that the contact was raised from')
	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => false,
		'default' => 'CURRENT_TIMESTAMP',
	), 'Time contact was created')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
    ), 'submitted name value')
	->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => false,
	), 'submitted email value')
	->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => false,
	), 'submitted telephone value')
	->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => false,
	), 'submitted comment value');
$installer->getConnection()->createTable($table);

$installer->endSetup();


