<?php
// We call it LlapgochBannersController to keep us from clashing with any other banner modules
class Llapgoch_Banners_Adminhtml_LlapgochbannersController extends Mage_Adminhtml_Controller_Action{
	protected function _initAction(){
		$this->_setActiveMenu('cms/llapgoch_banners');
	}
	
	public function indexAction(){
		$this->loadLayout();
		$this->_initAction();
		
		$this->renderLayout();
	}
	
	public function editbanneritemsAction(){
		$this->loadLayout();
		$this->_initAction();
		
		$this->renderLayout();
	}
	
	
}