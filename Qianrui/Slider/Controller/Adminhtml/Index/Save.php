<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Qianrui_Slider::index';

    protected $_resultPageFactory;
	protected $_resultPage;

	public function __construct(
	    Context $context,
        PageFactory $resultPageFactory
    ){
		parent::__construct($context);
		$this->_resultPageFactory = $resultPageFactory;
	}

	public function execute(){
        $id = $this->getRequest()->getParam('id');
        $data = $this->getRequest()->getParams();
        $model = $this->_objectManager->create('Qianrui\Slider\Model\Slider');
        $resultRedirect = $this->resultRedirectFactory->create();

        $this->getLogger()->info('form-data-1', $data);
        if(isset($data['image']) && is_array($data['image'])){
            $data['image'] = $data['image'][0]['name'];
        }
        $this->getLogger()->info('form-data-2', $data);

        if($id) {
			$model->load($id);
		}
		$model->setData($data);

		try {
			$model->save();
			$this->messageManager->addSuccess(__('Saved.'));
			if ($this->getRequest()->getParam('back')) {
				return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
			}
			$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
			return $resultRedirect->setPath('*/*/');
		} catch (\Exception $e) {
			$this->messageManager->addException($e, __('Something went wrong.'));
		}

		$this->_getSession()->setFormData($data);
		return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
	}

    protected $logger;
    protected function getLogger(){
        if($this->logger===null){
            $this->logger = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Psr\Log\LoggerInterface::class);
        }

        return $this->logger;
    }
}