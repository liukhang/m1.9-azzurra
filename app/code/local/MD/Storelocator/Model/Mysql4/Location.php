<?php
class MD_Storelocator_Model_Mysql4_Location extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('storelocator/location', 'location_id');
    }
}