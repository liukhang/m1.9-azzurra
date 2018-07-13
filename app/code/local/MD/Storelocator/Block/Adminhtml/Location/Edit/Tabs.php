<?php
class MD_Storelocator_Block_Adminhtml_Location_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('location_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('storelocator')->__('Manage Locations'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('storelocator')->__('Location Information'),
            'title'     => Mage::helper('storelocator')->__('Location Information'),
            'content'   => $this->getLayout()->createBlock('storelocator/adminhtml_location_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}