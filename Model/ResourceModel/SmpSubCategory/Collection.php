<?php
 
namespace SMP\Grid\Model\ResourceModel\SmpSubCategory;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('SMP\Grid\Model\SmpSubCategory', 'SMP\Grid\Model\ResourceModel\SmpSubCategory');
    }
}