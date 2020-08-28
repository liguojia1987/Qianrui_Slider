<?php
namespace Qianrui\Slider\Model\Slider;

use Qianrui\Slider\Model\ResourceModel\Slider\CollectionFactory as CollectionFactory;


/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Qianrui\Slider\Model\ResourceModel\Slider\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        /** @var \Qianrui\Slider\Model\Slider $item */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();

            // 图片
            if ($item->getImage()) {
                $m['image'][0]['name'] = $item->getImage();
                $m['image'][0]['url'] = $item->getImageUrl();

                $this->loadedData[$item->getId()] = array_merge(
                    $this->loadedData[$item->getId()],
                    $m
                );
            }

        }

        return $this->loadedData;
    }
}
