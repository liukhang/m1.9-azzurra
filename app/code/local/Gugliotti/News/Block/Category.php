<?php
/**
 * Gugliotti_News_Block_Category
 */

/**
 * Class Gugliotti_News_Block_Category
 *
 * Block for news categories pages.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Category extends Mage_Core_Block_Template
{
	/**
	 * getNewsByCategory
	 *
	 * Get all news for a given category. If no category is provided, returns all news.
	 * @param integer $category
	 * @return Gugliotti_News_Model_Resource_Story_Collection
	 */
	public function getNewsByCategory($category = null)
	{
		// get all news for a given category
		$stories = Mage::getModel('gugliotti_news/story')->getCollection()
			->addFieldToFilter('status', array('eq' => 1));
		if ($category) {
			$stories->addFieldToFilter('category_id', array('eq' => $category));
		}

		return $stories;
	}

	/**
	 * countNewsForCategory
	 *
	 * Count the active stories for a given categories.
	 * @param int $categoryId
	 * @return int
	 */
	public function countNewsForCategory($categoryId)
	{
		$collection = Mage::getModel('gugliotti_news/story')->getCollection()
			->addFieldToFilter('category_id', array('eq' => $categoryId))
			->addFieldToFilter('status', array('eq' => 1));
		return $collection->count();
	}
}
