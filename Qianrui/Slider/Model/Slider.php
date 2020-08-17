<?php
namespace Qianrui\Slider\Model;

use Magento\Framework\UrlInterface;

class Slider extends \Magento\Framework\Model\AbstractModel
{
    protected $storeManager;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->storeManager = $storeManager;

        parent::__construct($context, $registry);
    }

    public function _construct()
    {
        $this->_init('Qianrui\Slider\Model\ResourceModel\Slider');
    }

    /**
     * 图片url
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . '/' . $this->prepareFile($this->getData('image'));
    }

    public function prepareFile($file)
    {
        return ltrim(str_replace('\\', '/', $file), '/');
    }
}