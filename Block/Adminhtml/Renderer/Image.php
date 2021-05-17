<?php
namespace SMP\Grid\Block\Adminhtml\Renderer;

use Magento\Framework\Data\Form\Element\Image as ImageField;
use Magento\Framework\Data\Form\Element\Factory as ElementFactory;
use Magento\Framework\Data\Form\Element\CollectionFactory as ElementCollectionFactory;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Image extends ImageField
{

    protected $_imageModel;
    private $_storeManager;


    public function __construct(
        ElementFactory $factoryElement,
        ElementCollectionFactory $factoryCollection,
        Escaper $escaper,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storemanager,
        $data = []
    ) {
        $this->_storeManager = $storemanager;
        parent::__construct(
            $factoryElement, $factoryCollection, $escaper, $urlBuilder, $data
        );
    }

    protected function _getUrl()
    {
        $url = false;
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(
            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
        ). 'images/';
        if ($this->getValue()) {
            $url = $mediaDirectory . $this->getValue();
        }
        return $url;
    }

    // public function getElementHtml() {
    //     $html = '';
    //     $html .= parent::getElementHtml();
    //     $html = '<div id="customdiv"><img src="'.$this->_getUrl().'" width="250px" height="auto"></img></div>';
    //     $this->setClass('input-file');
    //     $html .= $this->_getDeleteCheckbox();
    //     return $html;
    // }

}