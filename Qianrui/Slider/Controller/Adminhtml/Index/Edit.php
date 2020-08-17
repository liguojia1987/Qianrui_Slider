<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;

class Edit extends Action
{
    const ADMIN_RESOURCE =  'Qianrui_Slider::index';

    protected $_coreRegistry = null;
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;

        parent::__construct($context);
    }

    public function execute(){
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Qianrui\Slider\Model\Slider');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('slider', $model);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Qianrui_Slider::index');
        $resultPage->addBreadcrumb(__('Slider'), __('Slider'))
            ->addBreadcrumb(
                $id ? __('Edit') : __('New'),
                $id ? __('Edit') : __('New')
            );
        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Edit') : __('New')
        );

        return $resultPage;
    }
}