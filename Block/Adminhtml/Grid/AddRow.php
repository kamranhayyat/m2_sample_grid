<?php

namespace SMP\Grid\Block\Adminhtml\Grid;
 
class AddRow extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    protected $smpCatCollection = null;
 
    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \SMP\Grid\Model\ResourceModel\SmpCategory\CollectionFactory $smpCatCollectionFactory,
        array $data = []
    ) 
    {
        $this->_coreRegistry = $registry;
        $this->smpCatCollection = $smpCatCollectionFactory->create();
        parent::__construct($context, $data);
    }
 
    /**
     * Initialize Imagegallery Images Edit Block.
     */
    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'SMP_Grid';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();
        if ($this->_isAllowedAction('SMP_Grid::add_row')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
    }
 
    /**
     * Retrieve text for header element depending on loaded image.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Add RoW Data');
    }
 
    /**
     * Check permission for passed action.
     *
     * @param string $resourceId
     *
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
 
    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
 
        return $this->getUrl('*/*/save');
    }

    public function getParentCategories() {
        $parentCategories = [];
        $categories = [];
        $filteredCollection = $this->smpCatCollection
                        ->addFieldToSelect('id')
                        ->addFieldToSelect('name')
                        ->addFieldToFilter('pid', ['eq' => 0]);
        foreach($filteredCollection as $key => $cat) {
            $parentCategories[] = [$cat->getId() => $cat->getName()];
        }
        foreach($parentCategories as $cat) {
            $categories += $cat;
        }
        // echo "<pre>";print_r($categories);exit;
        return $categories;
    }
}