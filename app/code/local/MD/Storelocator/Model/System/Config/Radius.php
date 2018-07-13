<?php
class MD_Storelocator_Model_System_Config_Radius
{
    public function toOptionArray()
    {
        return array(
            array('value'=>999999, 'label'=>'Please select radius'),
            array('value'=>50, 'label'=>Mage::helper('storelocator')->__('50 KM')),
            array('value'=>100, 'label'=>Mage::helper('storelocator')->__('100 KM')),            
            array('value'=>200, 'label'=>Mage::helper('storelocator')->__('200 KM')),
			array('value'=>500, 'label'=>Mage::helper('storelocator')->__('500 KM')),
			array('value'=>1000, 'label'=>Mage::helper('storelocator')->__('1000 KM')),
			array('value'=>5000, 'label'=>Mage::helper('storelocator')->__('5000 KM')),
			array('value'=>10000, 'label'=>Mage::helper('storelocator')->__('10000 KM')),
        );
    }
} 