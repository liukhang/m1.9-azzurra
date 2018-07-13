<?php
/**
 * Gugliotti_News_Block_Widgetlist
 */

/**
 * Class Gugliotti_News_Block_Widgetlist
 *
 * Block for stories pages.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Widgetlist extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
	/**
	 * @var null
	 */
	protected $_serializer = null;

	/**
	 * Constructor
	 */
	public function _construct()
	{
		$this->_serializer = new Varien_Object();
		parent::_construct();
	}

	/**
	 * getLatestNews
	 *
	 * Returns the latest news collection to be used on widget.
	 * @return Gugliotti_News_Model_Story
	 */
	public function getLatestNews()
	{
		// get number of news from widget configuration
		$numberOfNews = $this->getData('number_of_news');

		// load collection
		$stories = Mage::getModel('gugliotti_news/story')->getCollection()
			->setPageSize($numberOfNews)
			->setCurPage(1);

		return $stories;
	}

}
