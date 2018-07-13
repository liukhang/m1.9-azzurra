<?php
/**
 * Gugliotti_News_Model_Story
 */

/**
 * Class Gugliotti_News_Model_Story
 *
 * Model for Story.
 * @method string getTitle()
 * @method setTitle(string $title)
 * @method string getThumbnailPath()
 * @method setThumbnailPath(string $thumbnailPath)
 * @method string getContent()
 * @method setContent(string $content)
 * @method boolean getStatus()
 * @method setStatus(boolean $status)
 * @method int getCategoryId()
 * @method setCategoryId(int $categoryId)
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 * @method setUpdatedAt(string $updatedAt)
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Story extends Mage_Core_Model_Abstract
{
    /**
     * $_eventPrefix
     * @var string
     */
    protected $_eventPrefix = 'gugliotti_news_story';

    /**
     * $_eventObject
     * @var string
     */
    protected $_eventObject = 'story';

	/**
	 * Constructor
	 */
    protected function _construct()
    {
        $this->_init('gugliotti_news/story');
    }

	/**
	 * Set date of last update for story
	 *
	 * @return Gugliotti_News_Model_Story
	 */
    protected function _beforeSave()
	{
		parent::_beforeSave();
		$this->setUpdatedAt(Mage::getSingleton('core/date')->gmtDate());
		return $this;
	}

	/**
	 * setCategory
	 *
	 * Set Category into Story.
	 * @param Gugliotti_News_Model_Category $category
	 * @return $this
	 */
	public function setCategory(Gugliotti_News_Model_Category $category)
	{
		$this->setCategoryId($category->getId());
		return $this;
	}

	/**
	 * getCategory
	 *
	 * Get Category from Story.
	 * @return Gugliotti_News_Model_Category|Mage_Core_Model_Abstract
	 */
	public function getCategory()
	{
		return Mage::getModel('gugliotti_news/category')->load($this->getCategoryId());
	}

	/**
	 * getPublishedStories
	 *
	 * Return only published stories.
	 * @return Gugliotti_News_Model_Resource_Story_Collection
	 */
	public function getPublishedStories()
	{
		return $this->getCollection()
			->addFieldToFilter('status', array('eq' => 1));
	}
}
