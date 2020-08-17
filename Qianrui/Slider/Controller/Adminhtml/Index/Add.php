<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

class Add extends \Magento\Backend\App\Action
{
    public function execute(){
        // 直接转发给edit
        $this->_forward('edit');
    }
}