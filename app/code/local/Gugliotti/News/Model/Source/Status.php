<?php
/**
 * Gugliotti_News_Model_Source_Status
 */

/**
 * Class Gugliotti_News_Model_Source_Status
 *
 * Status for Categories and Stories.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Source_Status
{
	/**
	 * toOptionArray
	 *
	 * Used to fill dropdown menus.
	 * @return array
	 */
	public function toOptionArray()
	{
		return array(
			array('value' => 0, 'label' => Mage::helper('gugliotti_news')->__('Unpublished')),
			array('value' => 1, 'label' => Mage::helper('gugliotti_news')->__('Published')),
		);
	}

	/**
	 * toGridArray
	 *
	 * Returns toOptionArray method as options to grid column.
	 * @return array
	 */
	public function toGridArray()
	{
		$array = array();
		foreach ($this->toOptionArray() as $option) {
			$array[$option['value']] = $option['label'];
		}
		return $array;
	}
}
