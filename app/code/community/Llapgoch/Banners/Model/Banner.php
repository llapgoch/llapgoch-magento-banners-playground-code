<?php
class Llapgoch_Banners_Model_Banner extends Mage_Core_Model_Abstract{
	protected function _construct(){
		// Set the resource name for the model. This will also set the resource collection name 
		// to llapgoch_banners_banner_collection
		$this->_init('llapgoch_banners/banner');
	}
}