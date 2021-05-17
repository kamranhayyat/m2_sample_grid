<?php
 
namespace SMP\Grid\Controller\Adminhtml\SubGrid;
 
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \SMP\Grid\Model\GridFactory
     */
    var $smpCatFactory;
    var $fileUploader;
 
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \SMP\Grid\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \SMP\Grid\Model\SmpCategoryFactory $smpCatFactory,
        \SMP\Grid\Model\Upload\ImageFileUploader $fileUploader
    ) {
        parent::__construct($context);
        $this->smpCatFactory = $smpCatFactory;
        $this->fileUploader = $fileUploader;
    }
 
    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $result = $this->fileUploader->saveImageToMediaFolder();
        $data['image'] = $_FILES['image']['name'] ? str_replace(' ', '_', $_FILES['image']['name']) : null;
        // echo "<pre>";print_r($data);exit;
        if (!$data) {
            $this->_redirect('grid/grid/addrow');
            return;
        }
        try {
            $rowData = $this->smpCatFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('grid/subgrid/index');
    }
 
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SMP_Grid::save');
    }
}