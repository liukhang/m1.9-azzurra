<?php
class MD_Storelocator_LocationController extends Mage_Core_Controller_Front_Action
{
    public function mapAction()
    {
		
        $this->loadLayout();
        $this->renderLayout();
		
    }
	public function getlistAction()
    {
		$this->loadLayout();
        $this->renderLayout();		 
    }
	public function getfinterAction()
    {
		$this->loadLayout();
        $this->renderLayout(); 
    }
}