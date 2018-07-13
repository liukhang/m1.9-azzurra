<?php
/**
 * Gugliotti_News_Block_Adminhtml_Category_Edit_Form
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Category_Edit_Form
 *
 * Adminhtml Category Edit.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Category_Edit_Form constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('gugliotti_news_category_edit_form');
	}

    /**
     * _prepareForm
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
	protected function _prepareForm()
	{
		// prepare form
		$form = new Varien_Data_Form(
			array(
				'id' => 'edit_form',
				'method' => 'post',
				'action' => $this->getUrl('*/*/save', array('category_id' => $this->getRequest()->getParam('category_id'))),
				'enctype' => 'multipart/form-data',
			)
		);
		$form->setData('html_id_prefix', 'category_');

		$fieldset = $form->addFieldset(
			'base_fieldset',
			array(
				'legend' => $this->__('General Information'),
				'class' => 'fieldset-wide',
			)
		);
		$fieldset->addField(
			'code',
			'text',
			array(
				'name' => 'code',
				'label' => $this->__('Code'),
				'title' => $this->__('Code'),
				'required' => true,
			)
		);
		$fieldset->addField(
			'label',
			'text',
			array(
				'name' => 'label',
				'label' => $this->__('Label'),
				'title' => $this->__('Label'),
				'required' => true,
			)
		);

		$statusValues = Mage::getModel('gugliotti_news/source_status')->toOptionArray();
		$fieldset->addField(
			'status',
			'select',
			array(
				'name' => 'status',
				'label' => $this->__('Status'),
				'title' => $this->__('Status'),
				'required' => true,
				'values' => $statusValues,
			)
		);

		// if category_id is defined, load the object
		$categoryId = $this->getRequest()->getParam('category_id');
		if ($categoryId) {
			$model = Mage::getModel('gugliotti_news/category')->load($categoryId);
			if (!$model || !$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError($this->__('There was an error when loading the category. Please, return to the previous page and try again'));
			}
			$form->setValues($model->getData());
		}

		$form->setData('use_container', true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
