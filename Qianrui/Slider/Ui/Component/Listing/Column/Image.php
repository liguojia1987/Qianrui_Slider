<?php
namespace Qianrui\Slider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Image extends \Magento\Ui\Component\Listing\Columns\Column
{
	protected $sliderFactory;

	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		\Qianrui\Slider\Model\SliderFactory $sliderFactory,
		array $components = [],
		array $data = []
	) {
		$this->sliderFactory = $sliderFactory;

		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	public function prepareDataSource(array $dataSource) {
		if(isset($dataSource['data']['items'])) {
		    $_model = $this->sliderFactory->create();
			foreach($dataSource['data']['items'] as & $item) {
			    /** @var \Qianrui\Slider\Model\Slider $model */
			    $model = clone $_model;
			    $item['image_src'] = $model->load($item['id'])->getImageUrl();
			}
		}

		return $dataSource;
	}
}