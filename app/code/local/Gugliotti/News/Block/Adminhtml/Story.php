<?php
/**
 * Gugliotti_News_Block_Adminhtml_Story
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Story
 *
 * Adminhtml Story Grid.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Story extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Story constructor.
	 */
	public function __construct()
	{
		$this->_blockGroup = 'gugliotti_news';
		$this->_controller = 'adminhtml_story';
		$this->_headerText = $this->__('News Stories Management');
		parent::__construct();
	}
}
