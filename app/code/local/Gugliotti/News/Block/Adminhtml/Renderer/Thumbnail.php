<?php
/**
 * Gugliotti_News_Block_Adminhtml_Renderer_Thumbnail
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Renderer_Thumbnail
 *
 * Grid renderer for thumbnail column.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Renderer_Thumbnail
	extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	/**
	 * render
	 *
	 * Used to render data for a grid column in a fancy way.
	 * @param Varien_Object|Gugliotti_News_Model_Story $row
	 * @return string
	 */
	public function render(Varien_Object $row)
	{
		// control if file exists
		$fullPathDir = Mage::getBaseDir(
		    Mage_Core_Model_Store::URL_TYPE_MEDIA)
            . DS
            . Mage::helper('gugliotti_news')->getMediaFolder()
            . DS
            . $row->getThumbnailPath();
		if (!$row->getThumbnailPath() || !file_exists($fullPathDir)) {
			return '';
		}

		// prepare URL and return image HTML
		$fullPath = Mage::getBaseUrl(
		    Mage_Core_Model_Store::URL_TYPE_MEDIA)
            . Mage::helper('gugliotti_news')->getMediaFolder()
            . DS
            . $row->getThumbnailPath();
		return '<img id="thumbnail-' . $this->getColumn()->getId() . '" src="' . $fullPath . '" class="grid-image" style="max-width:100px" />';
	}
}
