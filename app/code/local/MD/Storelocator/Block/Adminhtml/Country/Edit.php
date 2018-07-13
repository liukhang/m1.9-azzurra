<?php
class MD_Storelocator_Block_Adminhtml_Country_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_country';

        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Save Country'));
        $this->_updateButton('delete', 'label', Mage::helper('storelocator')->__('Delete Country'));

        if( $this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('storelocator/country')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('country_data', $model);
        }


    }

    public function getHeaderText()
    {
        if( Mage::registry('country_data') && Mage::registry('country_data')->getId() ) {
            return Mage::helper('storelocator')->__("Edit Country", $this->htmlEscape(Mage::registry('country_data')->getTitle()));
        } else {
            return Mage::helper('storelocator')->__('New Country');
        }
    }
}