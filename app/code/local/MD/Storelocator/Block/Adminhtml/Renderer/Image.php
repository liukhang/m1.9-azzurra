<?php
class MD_Storelocator_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {
        $values = $this->getColumn()->getValues(); 
        $value  = $row->getData($this->getColumn()->getIndex());  /* ten file */
        $url = Mage::getBaseUrl('media').$value;
        return '<a href="'.$url .'" target="_blank"><img width=80 src="'.$url.'" /></a>';
    }
}