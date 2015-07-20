<?php
class Llapgoch_Banners_Model_Resource_Banner_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
	protected function _construct(){
		parent::_construct();
		$this->_init('llapgoch_banners/banner');
	}
}