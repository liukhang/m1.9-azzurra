<?php
/**
 * Gugliotti_News_Block_Adminhtml_Story_Edit
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Story_Edit
 *
 * Adminhtml Story Edit.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Story_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Story_Edit constructor.
	 */
	public function __construct()
	{
		$this->_objectId = 'story_id';
		$this->_blockGroup = 'gugliotti_news';
		$this->_controller = 'adminhtml_story';
		$this->_addButton(
			'saveandcontinue',
			array(
				'label' => $this->__('Save and Continue'),
				'onclick' => 'saveAndContinueEdit()',
				'class' => 'save',
			),
			'100'
		);
		$this->_formScripts[] = "
		function saveAndContinueEdit() {
			editForm.submit($('edit_form').action + 'back/edit/');
		}
		";
		parent::__construct();
	}

	/**
	 * getHeaderText
	 * @return string
	 */
	public function getHeaderText()
	{
		return $this->__('Category Details');
	}

	/**
	 * _prepareLayout
	 *
	 * Used to include TinyMCE, if enabled.
	 */
	protected function _prepareLayout()
	{
		parent::_prepareLayout();
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setData('can_load_tiny_mce', true);
		}
	}
}
