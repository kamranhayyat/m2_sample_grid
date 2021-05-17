<?php

namespace SMP\Grid\Block\Adminhtml\Grid\Edit;
 
/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $addRowBlock;
    protected $request;

 
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        // \SMP\Grid\Model\CategoryStatus $options,
        \SMP\Grid\Block\Adminhtml\Grid\AddRow $addRowBlock,
        \Magento\Framework\App\Request\Http $request,
        array $data = []
    ) 
    {
        // $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->addRowBlock = $addRowBlock;
        $this->request = $request;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );
 
        $form->setHtmlIdPrefix('smp_');
        if ($model->getId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }
 
        $controller = $this->request->getControllerName();

        if($controller == 'subgrid') {
            $fieldset->addField(
                'pid',
                'select',
                [
                    'name' => 'pid',
                    'label' => __('Parent Category'),
                    'id' => 'pid',
                    'title' => __('Parent Category'),
                    'options' => $this->addRowBlock->getParentCategories()
                    // 'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
                ]
            );
        }
 
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
            ]
        );

        $fieldset->addField(
            'name_in_ar',
            'text',
            [
                'name' => 'name_in_ar',
                'label' => __('Name in arabic'),
                'id' => 'name_in_ar',
                'title' => __('Name in arabic'),
            ]
        );

        $fieldset->addType('image', '\SMP\Grid\Block\Adminhtml\Renderer\Image');

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'id' => 'image',
                'title' => __('Image'),
            ]
        );
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}
