<?php
class MD_Storelocator_Helper_Data extends Mage_Core_Helper_Data
{
    protected $_locations = array();

    public function getLocation($id)
    {
        if (!isset($this->_locations[$id])) {
            $location = Mage::getModel('storelocator/location')->load($id);
            $this->_locations[$id] = $location->getId() ? $location : false;
        }
        return $this->_locations[$id];
    }
}