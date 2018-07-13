
<?php
class MD_Storelocator_Block_Adminhtml_Country extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_country';
        $this->_headerText = Mage::helper('storelocator')->__('Manage Country');
        $this->_addButtonLabel = Mage::helper('storelocator')->__('Add New Country');
        parent::__construct();
    }
}