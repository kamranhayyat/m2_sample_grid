<?php

namespace SMP\Grid\Model\Upload;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class ImageFileUploader {
    
    protected $_fileUploaderFactory;
    protected $_filesystem;

	public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $_filesystem
	) {
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->_filesystem = $_filesystem;
	}
 
	public function saveImageToMediaFolder() {

		$uploader = $this->_fileUploaderFactory->create(['fileId' => 'image']);
		 
		$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
		 
		$uploader->setAllowRenameFiles(false);
		 
		$uploader->setFilesDispersion(false);

		$path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
		 
		->getAbsolutePath('images/');
		 
		$uploader->save($path);
		
		return $uploader;
	}
}

	