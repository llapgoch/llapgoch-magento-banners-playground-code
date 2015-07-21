<?php
$installer = $this;

$installer->startSetup();


// Remove if it exists
$this->getConnection()->dropTable($this->getTable('llapgoch_banners/banner'));

// Create the banner table
$this->getConnection()->createTable(
	$this->getConnection()->newTable($installer->getTable('llapgoch_banners/banner'))
	->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable' => false,
		// This will automatically create a primary key index for us
		// If multiple keys with 'primary' are set, aggregate keys are created.
		'primary' => true, 
		'identity' => true,
		'unsigned' => true
	), 'Banner Id')
	->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => true,
	), 'Banner Title')
	->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
		'nullable' => false,
		'default' => 0
	), 'Is Banner Active')
	->addColumn('created_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => false
	), 'Banner Created Time')
	->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => true
	), 'Banner Modified Time')
	->setComment('LLAP-Goch Banner Table')
);

$this->getConnection()->dropTable($installer->getTable('llapgoch_banners/banner_item'));

// Create the banner items table
$this->getConnection()->createTable(
	$this->getConnection()->newTable($installer->getTable('llapgoch_banners/banner_item'))
	->addColumn('banner_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'nullable' => false,
		'primary' => true,
		'identity' => true,
		'unsigned' => true
	), 'Banner Item Id')
	->addColumn('banner_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
	), 'Banner Id')
	->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => true
	), 'Banner Item Title')
	->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'nullable' => true
	), 'Banner Item Content')
	->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
		'default' => 1,
		'nullable' => false
	), 'Is Banner Item Active')
	->addColumn('link_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => true
	), 'Banner Link URL')
	->addColumn('banner_order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable' => true,
		'default' => 0
	), 'The order the banners will be output in')
	->addColumn('created_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => false
	), 'Banner Item Created Time')
	->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => true
	), 'Banner Item Modified Time')
		// The method getFkName generates the name from the data passed in,
		// ACTION_CASCADE means that when deleting something from the reference table, items in this table
		// also get deleted. ACTION_RESTRICT will prevent rows in the reference table from being removed
		// if rows exist in this table.
	->addForeignKey($installer->getFkName('llapgoch_banners/banner_item', 'banner_id', 'llapgoch_banners/banner', 'banner_id'), 'banner_id', $installer->getTable('llapgoch_banners/banner'), 'banner_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('LLAP-Goch Banner Item Table')
);

// Banner Item Image
$this->getConnection()->dropTable($installer->getTable('llapgoch_banners/banner_item_image'));

$this->getConnection()->createTable(
	$this->getConnection()->newTable($installer->getTable('llapgoch_banners/banner_item_image'))
	->addColumn('banner_item_image_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'primary' => true,
		'identity' => true,
		'unsigned' => true
	), 'Banner Image Item Id')
	->addColumn('banner_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => true
	), 'Banner Item Id')
	->addColumn('path', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false
	), 'Path to the image file')
	->addColumn('screen_width_min', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable' => true
	), 'The minimum screen width to show the image')
	->addColumn('screen_width_max', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable' => true
	), 'The maximum screen width to show the image')
	->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => false
	), 'Banner Created Time')
	->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		'nullable' => true
	), 'Banner Modified Time')
	->addForeignKey($installer->getFkName('llapgoch_banners/banner_item_image', 'banner_item_id', 'llapgoch_banners/banner_item', 'banner_item_id'), 'banner_item_id', $installer->getTable('llapgoch_banners/banner_item'), 'banner_item_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
);

$installer->endSetup();