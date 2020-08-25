<?php
namespace Qianrui\Slider\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
	public function getConfigValue($path, $storeId){
		return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $storeId);
	}
}