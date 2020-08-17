<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE =  'Qianrui_Slider::index';

    /**
     * @var PageFactory
     */
	protected $_resultPageFactory;

	public function __construct(
	    Context $context,
        PageFactory $resultPageFactory
    ){
		parent::__construct($context);
		$this->_resultPageFactory = $resultPageFactory;
	}

	public function execute(){
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Qianrui_Slider::index');
        $resultPage->getConfig()->getTitle()->prepend((__('Sliders')));

		return $resultPage;
	}
}