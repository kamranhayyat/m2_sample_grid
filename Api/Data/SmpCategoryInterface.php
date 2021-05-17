<?php

namespace SMP\Grid\Api\Data;
 
interface SmpCategoryInterface {

    const ID = 'id';
    const PID = 'pid';
    const NAME = 'name';
    const NAME_IN_AR = 'name_in_ar';
    const IMAGE= 'image';
 
    public function getId();

    public function setId($id);

    public function getPid();

    public function setPid($pid);

    public function getName();

    public function setName($name);

    public function getNameInArabic();

    public function setNameInArabic($name_in_arr);

    public function getImage();

    public function setImage($image);
 
}