<?php

namespace SMP\Grid\Ui\Component\Listing\Column;
 
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;
 
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var string
     */
    private $editUrl;
 
    private $_objectManager = null;
    protected $_filesystem;
    protected $storeManager;
 
    
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        // \SMP\Hello\Model\Hello\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $components = [],
        \Magento\Framework\Filesystem $_filesystem,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        // $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        // $this->_getModel = $model;
        $this->_objectManager = $objectManager;
        $this->_filesystem = $_filesystem;
        $this->storeManager = $storeManager;
    }
 
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $url = $this->storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ).'images/'.$item[$fieldName];
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $item[$fieldName];
                $item[$fieldName . '_orig_src'] = $url;
            }
        }
 
        return $dataSource;
    }
}