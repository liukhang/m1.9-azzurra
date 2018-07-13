<?php
/**
 * Gugliotti_News_Block_Adminhtml_Category
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Category
 *
 * Adminhtml Category Grid.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Category constructor.
	 */
	public function __construct()
	{
		$this->_blockGroup = 'gugliotti_news';
		$this->_controller = 'adminhtml_category';
		$this->_headerText = $this->__('News Categories Management');
		parent::__construct();
	}
}
