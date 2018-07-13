<?php
class MD_Storelocator_Block_Adminhtml_Country_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('country_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('storelocator')->__('Manage Countrys'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('storelocator')->__('Country Information'),
            'title'     => Mage::helper('storelocator')->__('Country Information'),
            'content'   => $this->getLayout()->createBlock('storelocator/adminhtml_country_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}