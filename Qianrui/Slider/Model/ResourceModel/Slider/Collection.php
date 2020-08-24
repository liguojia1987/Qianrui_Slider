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

    /**
     * 启用
     *
     * @param $excluded
     * @param $selected
     * @return bool|string
     */
    public function enable($excluded, $selected){
        if (is_array($excluded) && !empty($excluded)) {
            $this->addFieldToFilter('id', ['nin' => $excluded]);
        } elseif (is_array($selected) && !empty($selected)) {
            $this->addFieldToFilter('id', ['in' => $selected]);
        }

        if($this->count()==0){
            return false;
        }

        $connection = $this->getConnection();
        $connection->beginTransaction();
        foreach ($this->getItems() as $item){
            $item->setData('active',1);
        }
        $this->save();
        $connection->commit();

        return true;
    }

    /**
     * 禁用
     *
     * @param $excluded
     * @param $selected
     * @return bool|string
     */
    public function disable($excluded, $selected){
        if (is_array($excluded) && !empty($excluded)) {
            $this->addFieldToFilter('id', ['nin' => $excluded]);
        } elseif (is_array($selected) && !empty($selected)) {
            $this->addFieldToFilter('id', ['in' => $selected]);
        }

        if($this->count()==0){
            return false;
        }

        $connection = $this->getConnection();
        $connection->beginTransaction();
        foreach ($this->getItems() as $item){
            $item->setData('active',0);
        }
        $this->save();
        $connection->commit();

        return true;
    }
}