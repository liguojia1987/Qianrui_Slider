<?php
namespace Qianrui\Slider\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Qianrui\Slider\Model\ResourceModel\Slider\CollectionFactory
     */
    protected $collectionFactory;

    protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Qianrui\Slider\Model\ResourceModel\Slider\CollectionFactory $collectionFactory,
        \Qianrui\Slider\Helper\Data $helper,
        array $data = []
    ){
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    public function getCollection(){
        /** @var \Qianrui\Slider\Model\ResourceModel\Slider\Collection $collection */
        $collection = $this->collectionFactory->create();
        if(!empty($this->getIds())){
            $collection->addFieldToFilter('id', ['in' => $this->getIds()]);
        }
        $collection->addFieldToFilter('active', 1);
        $collection->setOrder('sort', 'asc');
        return $collection;
    }

    private function getIds(){
        return $this->getData('ids');
    }

    public function isAutoplay(){
        return $this->helper->getConfigValue('qr_slider/options/autoplay', $this->_storeManager->getStore()->getId());
    }

    public function isLoop(){
        return $this->helper->getConfigValue('qr_slider/options/loop', $this->_storeManager->getStore()->getId());
    }
}