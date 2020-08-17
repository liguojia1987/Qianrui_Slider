<?php
namespace Qianrui\Slider\Controller\Adminhtml\Index\FileUploader;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;

class Save extends Action
{
    /**
     * Authorization level
     */
    const ADMIN_RESOURCE =  'Qianrui_Slider::index';

    const FILE_ID = 'image';

    const FILE_DIR = 'qianrui/slider';

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    protected $mediaDirectory;

    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);

        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => self::FILE_ID]);
            $uploader->setAllowCreateFolders(true);
            $uploader->setFilesDispersion(false);
            $uploader->setAllowedExtensions(['jpeg', 'jpg', 'png', 'gif']);
            $uploader->setAllowRenameFiles(true);
            $result = $uploader->save($this->mediaDirectory->getAbsolutePath(self::FILE_DIR));
            unset($result['path']);
            $result['name'] = $this->getMediaPath($result['file']);
            $result['url'] = $this->getMediaUrl($result['file']);

            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
        }catch(\Exception $e){

        }
    }

    /**
     * 图片path
     *
     * @param $file
     * @return string
     */
    protected function getMediaPath($file){
        return '/' . $this->mediaDirectory->getRelativePath(self::FILE_DIR) . '/' . $this->prepareFile($file);
    }

    /**
     * 图片url
     *
     * @param $file
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function getMediaUrl($file)
    {
        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . self::FILE_DIR . '/' . $this->prepareFile($file);
    }

    /**
     * Prepare file
     *
     * @param string $file
     * @return string
     */
    protected function prepareFile($file)
    {
        return ltrim(str_replace('\\', '/', $file), '/');
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
