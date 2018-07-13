<?php

class AsiaConnect_Gallery_Model_Gallery extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('gallery/gallery');
    }
	public function getTotalRate(){
		$collection = Mage::getModel('gallery/review')
		->getCollection()
		->addFieldToFilter('gallery_id', $this->getId())
		->addFieldToFilter('status',2/* Approved */);;
		return $collection->getSize();
	}
/*	static public function getCorrectFileName($fileName)
    {
        $fileName = preg_replace('/[^a-z0-9_\\-\\.]+/i', '_', $fileName);
        $fileInfo = pathinfo($fileName);

        if (preg_match('/^_+$/', $fileInfo['filename'])) {
            $fileName = 'file.' . $fileInfo['extension'];
        }
Mage::log('getCorrectFileName:  '.$fileName,Zend_Log::DEBUG,'gallery.log');        
        return $fileName;
    }*/
}