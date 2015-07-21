<?php
class Llapgoch_Banners_Helper_Adminhtml_Data extends Mage_Adminhtml_Helper_Data
{
	public function getEditBannerUrl($bannerId)
	{
		return $this->getUrl('*/*/editbanneritems', array(
			'banner' => $bannerId
		));
	}
}