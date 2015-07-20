<?php
class Llapgoch_Banners_Model_Resource_Banner extends Mage_Core_Model_Resource_Db_Abstract{
	protected function _construct(){
		$this->_init('llapgoch_banners/banner', 'banner_id');
	}
}