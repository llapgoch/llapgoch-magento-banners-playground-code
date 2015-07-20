<?php
class Llapgoch_Banners_Block_Adminhtml_Banners_Grid extends Mage_Adminhtml_Block_Widget_Grid{
	protected function _prepareCollection(){
		$collection = Mage::getResourceModel('llapgoch_banners/banner_collection');
		
	
		$collection->getSelect()->joinLeft(
			array('banner_item' => $collection->getTable('llapgoch_banners/banner_item')),
			'banner_item.banner_id=main_table.banner_id',
			array()			
		);
		
		$collection->getSelect()->group('main_table.banner_id');
		$collection->addExpressionFieldToSelect('num_banner_items', 'COUNT(*)', null);
		
		// $collection->getSelect()->columns('COUNT(*)');

		$this->setCollection($collection);
		
		echo $collection->getSelect();
		
		parent::_prepareCollection();
	}
	
	
	// Type should be one of the class definitions in 
	// Mage_Adminhtml_Block_Widget_Grid_Column_Renderer
	// checkbox, concat, country, currency, date, datetime, input, ip, longtext, massaction, number, options
	// price, radio, select, store, text, theme, wrapline
	protected function _prepareColumns(){
		parent::_prepareColumns();
		$helper = Mage::helper('llapgoch_banners');
		
		$this->addColumn('banner_id', array(
			'header' => $helper->__('ID'),
			'type' => 'text',
			'index' => 'banner_id',
			'width' => '150px'
		));
		
		$this->addColumn('title', array(
			'header' => $helper->__('Title'),
			'type' => 'string',
			'index' => 'title'
		));
		
		$this->addColumn('is_active', array(
			'header' => $helper->__('Active'),
			'type' => 'options',
			'index' => 'is_active',
			'width' => '150px',
			// Add options to the filter
			'options' => array(
				1 => 'Enabled',
				0 => 'Disabled'
			)
		));
		
		$this->addColumn('num_banner_items', array(
			'header' => $helper->__('Number of Banner Items'),
			'type' => 'options',
			'index' => 'num_banner_items',
			'width' => '150px',
			'options' => array(
				1 => 'Horse',
				2 => 'Two'
 			),
			'filter_condition_callback' => array($this, '_numBannersFilter'),
		));
		
		return $this;
	}
	
	// This allows us to filter properly on the number of banners which are available.
	// By default, Magento will try adding the query to the where clause, breaking everything
	// We also can't reference the alias' name as Magento strips it off when performing its pagination
	// operations, so we use the aggregate function in the having, too.
	protected function _numBannersFilter($collection, $column){
		$collection->getSelect()->having('COUNT(*) = ?', $column->getFilter()->getValue());
	}
	
}