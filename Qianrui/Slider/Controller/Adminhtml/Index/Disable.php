<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Disable extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE =  'Qianrui_Slider::index';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $collectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Qianrui\Slider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    /**
     * News List action
     *
     * @return void
     */
    public function execute()
    {
        $selected = $this->getRequest()->getParam('selected');
        $excluded = $this->getRequest()->getParam('excluded');

        try{
            $collection = $this->collectionFactory->create();
            $return = $collection->disable($excluded, $selected);
            if ($return){
                $this->messageManager->addSuccessMessage('Success');
            }else{
                $this->messageManager->addErrorMessage(__('Please select item(s).'));
            }
        }catch (\Exception $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        $this->_redirect('*/*/index');
    }
}
