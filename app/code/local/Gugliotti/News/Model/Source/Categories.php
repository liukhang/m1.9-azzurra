<?php
/**
 * Gugliotti_News_Model_Source_Categories
 */

/**
 * Class Gugliotti_News_Model_Source_Categories
 *
 * Categories list for dropdown menus.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Source_Categories
{
	/**
	 * toOptionArray
	 *
	 * Used to fill dropdown menus.
	 * @throws Exception
	 * @return array
	 */
	public function toOptionArray()
	{
		$categories = Mage::getModel('gugliotti_news/category')->getCollection();
		if (!$categories) {
			throw new Exception('There was an error when loading the categories for a dropdown menu.');
		}

		// loop categories and build array
		$array = array();
		foreach ($categories as $ca) {
			$array[] = array('value' => $ca->getId(), 'label' => $ca->getLabel());
		}
		return $array;
	}

	/**
	 * toGridArray
	 *
	 * Returns toOptionArray method as options to grid column.
	 * @return bool|array
	 */
	public function toGridArray()
	{
	    // get options
	    try {
	        $optionsArray = $this->toOptionArray();
        } catch (Exception $e) {
	        Mage::logException($e);
	        return false;
        }

        if (!$optionsArray) {
	        return false;
        }

        // prepare new array
		$array = array();
		foreach ($optionsArray as $option) {
			$array[$option['value']] = $option['label'];
		}

		return $array;
	}
}
