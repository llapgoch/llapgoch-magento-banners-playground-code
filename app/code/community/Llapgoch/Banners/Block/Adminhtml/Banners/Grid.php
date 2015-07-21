<?php
class Llapgoch_Banners_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	protected function _construct(){
		parent::_construct();
		$this->setId('bannersGrid');
		$this->setDefaultSort('banner_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}
	
	protected function _prepareCollection(){
		$collection = Mage::getResourceModel('llapgoch_banners/banner_collection');
		
		$collection->getSelect()->joinLeft(
			array('banner_item' => $collection->getTable('llapgoch_banners/banner_item')),
			'banner_item.banner_id=main_table.banner_id',
			array()			
		);
		
		$collection->getSelect()->group('main_table.banner_id');
		$collection->addExpressionFieldToSelect('num_banner_items', 'COUNT(*)', null);
		// Another way to add an aggregate column
		// $collection->getSelect()->columns('COUNT(*)');
		$this->setCollection($collection);		
		
		// This has to be called after we've set our collection - it puts all of the filter
		// data onto our defined collection
		parent::_prepareCollection();
	}
	
	
	// Type should be one of the class definitions in 
	// Mage_Adminhtml_Block_Widget_Grid_Column_Renderer
	// checkbox, concat, country, currency, date, datetime, input, ip, longtext, massaction, number, options
	// price, radio, select, store, text, theme, wrapline
	protected function _prepareColumns(){
		parent::_prepareColumns();
		$helper = Mage::helper('llapgoch_banners');
		
		$this->addColumn('title', array(
			'header' => $helper->__('Title'),
			'type' => 'text',
			'index' => 'title'
		));
		
		$this->addColumn('is_active', array(
			'header' => $helper->__('Status'),
			'type' => 'options',
			'index' => 'is_active',
			'width' => '150px',
			// Add options to the filter
			'options' => array(
				1 => 'Enabled',
				0 => 'Disabled'
			),
			'filter_condition_callback' => array($this, '_isActiveFilter'),
		));
		
		$this->addColumn('num_banner_items', array(
			'header' => $helper->__('Number of Banner Items'),
			'type' => 'text',
			'index' => 'num_banner_items',
			'width' => '150px',
			
			'filter_condition_callback' => array($this, '_numBannersFilter'),
		));
		
		$this->addColumn('edit_banner_items', array(
			'header' => '',
			'type' => 'action',
			'index' => 'test',
			'width' => '200px',
			'getter' => 'getId',
			'actions' => array(
				array(
					'caption' => $helper->__('View Banner Items'),
					'url' => array(
						'base' => '*/*/editbanneritems',
						'field' => 'id' 
					)
				),
			),
			'sortable' => false,
			'filter' => false
		));
		
		return $this;
	}
	
	// This allows us to filter properly on the number of banners which are available.
	// By default, Magento will try adding the query to the where clause, breaking everything
	// We also can't reference the alias' name as Magento strips it off when performing its pagination
	// operations, so we use the aggregate function in the having, too.
	protected function _numBannersFilter($collection, $column){
		$collection->getSelect()->having('COUNT(*) = ?', $column->getFilter()->getValue());
		return $this;
	}
	
	// We need to do this because we've got two is_active fields (because of the join table)
	// So we bind it to the banners table here
	protected function _isActiveFilter($collection, $column){
		$collection->getSelect()->where(
			 "main_table.is_active = ?", $column->getFilter()->getValue()
		);
	}
	
}