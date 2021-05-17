<?php

namespace SMP\Grid\Model\ResourceModel;

class SmpCategory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
  
    protected $_idFieldName = 'id';
 
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }
 
    protected function _construct() {
        $this->_init('smpmarketplace_category', $this->_idFieldName);
    }
}