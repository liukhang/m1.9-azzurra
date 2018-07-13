<?php
/**
 * Gugliotti_News_Block_Adminhtml_Renderer_Status
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Renderer_Status
 *
 * Grid renderer for status column.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Renderer_Status
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	/**
	 * render
	 *
	 * Used to render data for a grid column in a fancy way.
	 * @param Varien_Object|Gugliotti_News_Model_Story|Gugliotti_News_Model_Category $row
	 * @return string
	 */
	public function render(Varien_Object $row)
	{
		if ($row->getStatus() == 0) {
			return '<span class="grid-severity-minor"><span>' . $this->__('Unpublished') . '</span></span>';
		}
		if ($row->getStatus() == 1) {
			return '<span class="grid-severity-notice"><span>' . $this->__('Published') . '</span></span>';
		}
		return '<span class="grid-severity-critical"><span>' . $this->__('Error') . '</span></span>';
	}
}
