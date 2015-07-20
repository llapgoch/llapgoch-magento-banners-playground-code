<?php
class Llapgoch_Banners_Adminhtml_BannersController extends Mage_Adminhtml_Controller_Action{
	protected function _initAction(){
		$this->_setActiveMenu('cms/llapgoch_banners');
	}
	
	public function indexAction(){
		$this->loadLayout();
		$this->_initAction();
		
		
		
		$this->renderLayout();
		
	}
}