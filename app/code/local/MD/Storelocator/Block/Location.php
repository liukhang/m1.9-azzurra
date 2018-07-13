<?php
class MD_Storelocator_Block_Location extends Mage_Core_Block_Template
{
	protected $country;

	public function getCountry()
	{
		$collection = Mage::getModel('storelocator/country')->getCollection()
							->addFieldToSelect('country_code')->distinct(true);


		foreach ($collection as $value) {

			$country_name= Mage::app()->getLocale()->getCountryTranslation($value->getCountryCode());
			$country[$value->getCountryCode()] = $country_name;

		}
		//$json_country = json_encode($country);
		return $country;

	}
	public function getLocation()
	{
		$name= $this->getRequest()->getParam('id_country');
		$collection = Mage::getModel('storelocator/location')->getCollection();				
				return $collection;
	}


}