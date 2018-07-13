<?php
/**
 * Gugliotti_News_Model_Category
 */

/**
 * Class Gugliotti_News_Model_Category
 *
 * Model for Category.
 * @method string getCode()
 * @method setCode(string $code)
 * @method string getLabel()
 * @method setLabel(string $label)
 * @method boolean getStatus()
 * @method setStatus(int $status)
 * @method string getCreatedAt()
 * @method string getUpdatedAt()
 * @method setUpdatedAt(string $updatedAt)
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Model_Category extends Mage_Core_Model_Abstract
{
	/**
     * $_eventPrefix
	 * @var string
	 */
	protected $_eventPrefix = 'gugliotti_news_category';

    /**
     * $_eventObject
     * @var string
     */
    protected $_eventObject = 'category';

	/**
	 * Constructor
	 */
    protected function _construct()
    {
        $this->_init('gugliotti_news/category');
    }

	/**
	 * Set date of last update for category
	 *
	 * @return Gugliotti_News_Model_Category
	 */
	protected function _beforeSave()
	{
		parent::_beforeSave();
		$this->setUpdatedAt(Mage::getSingleton('core/date')->gmtDate());
		return $this;
	}

	/**
	 * getPublishedCategories
	 *
	 * Return only published categories.
	 * @return Gugliotti_News_Model_Resource_Category_Collection|Mage_Eav_Model_Entity_Collection_Abstract
	 */
	public function getPublishedCategories()
	{
		return $this->getCollection()
			->addFieldToFilter('status', array('eq' => 1));
	}
}
