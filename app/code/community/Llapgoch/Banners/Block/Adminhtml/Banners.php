<?php
class Llapgoch_Banners_Block_Adminhtml_Banners extends Mage_Adminhtml_Block_Widget_Grid_Container{
	protected function _construct(){
		parent::_construct();
		$this->_blockGroup = "llapgoch_banners";
		$this->_controller = "adminhtml_banners";
	}
	
	public  function getHeaderText(){
		return $this->__('LLAP-Goch Banners');
	}
	
	
}