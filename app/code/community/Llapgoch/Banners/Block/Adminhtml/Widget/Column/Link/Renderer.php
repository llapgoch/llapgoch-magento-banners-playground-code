<?php
class Llapgoch_Banners_Block_Adminhtml_Widget_Column_Link_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$helper = Mage::helper('llapgoch_banners/adminhtml_data');
		return $helper->__("<a href='%s'>Edit Banner Items</a>", 
			$helper->getEditBannerUrl($row->getId())
		);
	}
}