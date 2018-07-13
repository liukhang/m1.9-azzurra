<?php
class MD_Storelocator_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Punti Vendita'));
        $this->renderLayout();		
    }
	
}