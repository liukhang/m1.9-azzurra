<?php
/**
 * Gugliotti_News_Model_Observers_Category
 */

/**
 * Class Gugliotti_News_Model_Observers_Category
 *
 * Observer Model for Categories.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Observers_Category
{
	/**
	 * createLogEntry
	 *
	 * Create a log entry when a category is saved.
	 * @param Varien_Event_Observer $observer
	 * @return Varien_Event_Observer
	 */
	public function createLogEntry(Varien_Event_Observer $observer)
	{
		// get category object
		$category = $observer->getData('category');

		// verify if this is a valid category object
		if (!$category || !$category->getId()) {
			return $observer;
		}

		// save the log, including the class name for better tracking
		Mage::helper('gugliotti_news/log')->log(__CLASS__ . ': a category was saved. ID: ' . $category->getId());
		return $observer;
	}

	/**
	 * changeCodeValue
	 *
	 * Changes the 'code' property value when meets a specific condition.
	 * @param Varien_Event_Observer $observer
	 * @return Varien_Event_Observer
	 */
	public function changeCodeValue(Varien_Event_Observer $observer)
	{
		// get category object
		$category = $observer->getData('category');

		// verify if this is a valid category object
		if (!$category || !$category->getId()) {
			return $observer;
		}

		// if code is equal to 'myBeautifulCode', change it to 'theObserverIsWorking'
		if ($category->getCode() == 'myBeautifulCode') {
			$category->setCode('theObserverIsWorking');
		}

		return $observer;
	}
}
