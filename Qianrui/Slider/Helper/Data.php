<?php
namespace Qianrui\Slider\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
	public function getConfigValue($field, $storeId = null){
		return $this->scopeConfig->getValue('sy_slider/'.$field, ScopeInterface::SCOPE_STORE, $storeId);
	}
}