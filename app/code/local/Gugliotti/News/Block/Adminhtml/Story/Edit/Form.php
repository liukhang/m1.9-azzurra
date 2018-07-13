<?php
/**
 * Gugliotti_News_Block_Adminhtml_Story_Edit_Form
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Story_Edit_Form
 * Adminhtml Story Edit.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Story_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Story_Edit_Form constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('gugliotti_news_story_edit_form');
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
				'action' => $this->getUrl(
				    '*/*/save',
                    array('story_id' => $this->getRequest()->getParam('story_id'))
                ),
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
			'title',
			'text',
			array(
				'name' => 'title',
				'label' => $this->__('Title'),
				'title' => $this->__('Title'),
				'required' => true,
			)
		);

		$categoryOptions = Mage::getModel('gugliotti_news/source_categories')->toOptionArray();
		$fieldset->addField(
			'category',
			'select',
			array(
				'name' => 'category',
				'label' => $this->__('Category'),
				'title' => $this->__('Category'),
				'required' => true,
				'values' => $categoryOptions,
			)
		);
		$fieldset->addField(
			'thumbnail',
			'image',
			array(
				'name' => 'thumbnail',
				'label' => $this->__('Thumbnail'),
				'title' => $this->__('Thumbnail'),
			)
		);

		$contentConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
		$fieldset->addField(
			'content',
			'editor',
			array(
				'name' => 'content',
				'label' => $this->__('Content'),
				'title' => $this->__('Content'),
				'required' => true,
				'style' => 'height: 15em;',
				'config' => $contentConfig,
				'wysiwyg' => true,
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

		// if story_id is defined, load the object
		$storyId = $this->getRequest()->getParam('story_id');
		if ($storyId) {
			$model = Mage::getModel('gugliotti_news/story')->load($storyId);
			if (!$model || !$model->getId()) {
				Mage::getSingleton('adminhtml/session')
                    ->addError(
                        $this->__(
                            'There was an error when loading the story. Please, return to the previous page and try again'
                        )
                    );
			}

			// thumbnail full path
			if ($model->getThumbnailPath()) {
				$thumbnailFullPath = Mage::getBaseUrl(
				    Mage_Core_Model_Store::URL_TYPE_MEDIA)
                    . Mage::helper('gugliotti_news')->getMediaFolder()
                    . DS
                    . $model->getThumbnailPath();
				$model->setData('thumbnail', $thumbnailFullPath);
			}

			$form->setValues($model->getData());
		}

		$form->setData('use_container', true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}
