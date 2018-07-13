
<?php
class MD_Storelocator_Block_Adminhtml_Location extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_location';
        $this->_headerText = Mage::helper('storelocator')->__('Manage Store Locations');
        $this->_addButtonLabel = Mage::helper('storelocator')->__('Add New Location');
        parent::__construct();
    }
}