<?php
class MD_Storelocator_Block_Adminhtml_Location_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_location';

        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Save Location'));
        $this->_updateButton('delete', 'label', Mage::helper('storelocator')->__('Delete Location'));

        if( $this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('storelocator/location')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('location_data', $model);
        }


    }

    public function getHeaderText()
    {
        if( Mage::registry('location_data') && Mage::registry('location_data')->getId() ) {
            return Mage::helper('storelocator')->__("Edit Location", $this->htmlEscape(Mage::registry('location_data')->getTitle()));
        } else {
            return Mage::helper('storelocator')->__('New Location');
        }
    }
}