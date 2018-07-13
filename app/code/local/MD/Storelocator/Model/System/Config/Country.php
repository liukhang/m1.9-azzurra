<?php
class MD_Storelocator_Model_System_Config_Country
{
    public function toOptionArray()
    {
        
		$collection = Mage::getSingleton('storelocator/country')->getCollection()
							->addFieldToSelect('country_code')->distinct(true);

		$country = array();
		foreach ($collection as $value) {

			$country_name= Mage::app()->getLocale()->getCountryTranslation($value->getCountryCode());
			$country[$value->getCountryCode()] = $country_name;

		}

        return $country;
    }
} 