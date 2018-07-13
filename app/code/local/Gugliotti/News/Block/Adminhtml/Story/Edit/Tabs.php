<?php
/**
 * Gugliotti_News_Block_Adminhtml_Story_Edit_Tabs
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Story_Edit_Tabs
 *
 * Adminhtml Story Edit.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Story_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Story_Edit_Tab constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('story_edit_tabs');
		$this->setDestElementId('story_edit_form');
	}

	/**
	 * _beforeToHtml
	 * @return Mage_Core_Block_Abstract
	 */
	protected function _beforeToHtml()
	{
	    try {
            $this->addTab(
                'category_details',
                array(
                    'label' => $this->__('Story Details'),
                    'title' => $this->__('Story Details'),
                )
            );
        } catch (Exception $e) {
	        Mage::logException($e);
        }

		return parent::_beforeToHtml();
	}
}
