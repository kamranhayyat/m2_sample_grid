<?php
 
namespace SMP\Grid\Model;
 
use SMP\Grid\Api\Data\SmpCategoryInterface;
 
class SmpSubCategory extends \Magento\Framework\Model\AbstractModel implements SmpCategoryInterface {

    const CACHE_TAG = 'smpmarketplace_subcategory';
 
    protected $_cacheTag = 'smpmarketplace_subcategory';
 
    protected $_eventPrefix = 'smpmarketplace_subcategory';

    protected function _construct(){
        $this->_init('SMP\Grid\Model\ResourceModel\SmpSubCategory');
    }
 
    public function getId(){
        return $this->getData(self::ID);
    }
 
    public function setId($id){
        return $this->setData(self::ID, $id);
    }

    public function getPid() {
        return $this->getData(self::PID);
    }

    public function setPid($pid) {
        return $this->setData(self::PID, $pid);
    }

    public function getName() {
        return $this->getData(self::NAME);
    }

    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    public function getNameInArabic() {
        return $this->getData(self::NAME_IN_AR);
    }

    public function setNameInArabic($name_in_arr) {
        return $this->setData(self::NAME_IN_AR, $name_in_arr);
    }

    public function getImage() {
        return $this->getData(self::IMAGE);
    }

    public function setImage($image) {
        return $this->setData(self::IMAGE, $image);
    }
 
}
