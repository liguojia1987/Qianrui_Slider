<?php
namespace Qianrui\Slider\Block\Widget;

class Index extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected function _toHtml(){
        // 指定block & 传递参数
        return $this->getLayout()->createBlock(
            \Qianrui\Slider\Block\Index::class,
            '',
            [
                'data' => [
                    'ids' => explode(",", $this->getData('ids')),
                    'template' => $this->getData('template')
                ]
            ]
        )->toHtml();
    }
}