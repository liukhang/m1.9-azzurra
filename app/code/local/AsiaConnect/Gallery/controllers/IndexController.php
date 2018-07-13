<?php
class AsiaConnect_Gallery_IndexController extends AsiaConnect_Gallery_Controller_Action
{
    public function indexAction()
    { 	
//    	echo "<img src='".Mage::helper('gallery/image')->init('gallery/P5021461.jpg')->resize(200,100)."'>";
//    	exit;
    	if (!Mage::getStoreConfig('gallery/info/enabled')) $this->_redirect('no-route');
    	$rootAlbum = Mage::getModel('gallery/album')->load(1);
    	Mage::register('current_album',$rootAlbum);
		$this->loadLayout();
		$breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs');
		$this->_addCrumb($breadcrumbBlock, Mage::helper('gallery')->__('Home'), Mage::helper('gallery')->__('Home'),Mage::getBaseUrl(),true);
		$this->_addCrumb($breadcrumbBlock, $rootAlbum->getTitle(), $rootAlbum->getTitle(),null,false,true);
		$this->renderLayout();
		//$this->_redirect('/');
    }
    
}
