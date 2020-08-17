<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;

class Delete extends Action
{
    const ADMIN_RESOURCE =  'Qianrui_Slider::index';

    public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id>0){
			$model = $this->_objectManager->create('Qianrui\Slider\Model\Slider');
			$model->load($id);
			try {
				$model->delete();
				$this->messageManager->addSuccess(__('Deleted.'));
			} catch (\Exception $e) {
				$this->messageManager->addSuccess(__('Something went wrong.'));
			}
		}
		$this->_redirect('qr_slider/index');
	}
}