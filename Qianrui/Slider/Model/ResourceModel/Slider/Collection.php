<?php
namespace Qianrui\Slider\Model\ResourceModel\Slider;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected function _construct() {
		$this->_init(
			\Qianrui\Slider\Model\Slider::class,
            \Qianrui\Slider\Model\ResourceModel\Slider::class
		);
	}
}