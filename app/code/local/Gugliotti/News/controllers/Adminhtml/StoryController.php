<?php
/**
 * Gugliotti_News_Controller_Adminhtml_StoryController
 */

/**
 * Class Gugliotti_News_Controller_Adminhtml_StoryController
 *
 * Adminhtml controller for managing stories.
 *
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @category Training Modules
 * @package Gugliotti News
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Adminhtml_StoryController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * indexAction
	 */
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	/**
	 * newAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function newAction()
	{
		return $this->_forward('edit');
	}

	/**
	 * editAction
	 */
	public function editAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	/**
	 * saveAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function saveAction()
	{
		// prepare model
		if ($this->getRequest()->getParam('story_id')) {
			$model = Mage::getModel('gugliotti_news/story')
                ->load($this->getRequest()->getParam('story_id'));
			if (!$model || !$model->getId()) {
				Mage::getSingleton('adminhtml/session')
                    ->addError($this->__('There was an error when loading the story. Please, try again.'));
				return $this->_redirect('*/*/');
			}
		} else {
			$model = Mage::getModel('gugliotti_news/story');
		}

		// prepare data to be saved
		$title = $this->getRequest()->getPost('title');
		$content = $this->getRequest()->getPost('content');
		$categoryId = $this->getRequest()->getPost('category');

		if (!$title || !$content || !$categoryId) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('A required field was not informed. Please, verify your form.'));
			return $this->_redirect('*/*/');
		}

		// verify if the category ID is a valid one
		$category = Mage::getModel('gugliotti_news/category')->load($categoryId);
		if (!$category || !$category->getId()) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('The selected category does not exist. Please, verify your form.'));
			return $this->_redirect('*/*/');
		}

		// handle image upload
		$thumbnailPath = null;
		if (isset($_FILES['thumbnail']['name']) && (file_exists($_FILES['thumbnail']['tmp_name']))) {
			$filePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA)
                . DS . Mage::helper('gugliotti_news')->getMediaFolder();

			try {
				$uploader = new Varien_File_Uploader('thumbnail');
				$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
				$uploader->setAllowRenameFiles(false);
				$uploader->setFilesDispersion(false);
				$uploader->save($filePath, $_FILES['thumbnail']['name']);
			} catch (Exception $e) {
				Mage::logException($e);
				Mage::getSingleton('adminhtml/session')
                    ->addError(
                        $this->__('There was an error when uploading the thumbnail for this story. Please, try again.')
                    );
				return $this->_redirect('*/*/');
			}

			$thumbnailPath = $_FILES['thumbnail']['name'];
		}

		// handle image delete
		$post = $this->getRequest()->getPost();
		if (isset($post['thumbnail']['delete']) && $post['thumbnail']['delete'] == 1) {
			Mage::helper('gugliotti_news')->deleteImage($model->getThumbnailPath());
		}

		// save data
		try {
			$model->setTitle($title);
			$model->setContent($content);
			$model->setCategoryId($categoryId);
			$model->setStatus($this->getRequest()->getPost('status'));
			$model->setThumbnailPath($thumbnailPath);
			$model->save();
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The story was successfully saved'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when saving the story. Please, try again'));
		}

		// redirect to edit page if Save and Continue was used
		if ($this->getRequest()->getParam('back') && $this->getRequest()->getParam('back') == 'edit') {
			return $this->_redirect('*/*/edit', array('story_id' => $model->getId()));
		}
		return $this->_redirect('*/*/');
	}

	/**
	 * deleteAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function deleteAction()
	{
		// get story ID
		$storyId = $this->getRequest()->getParam('story_id');
		if (!$storyId) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when deleting this entry. Please, try again'));
			return $this->_redirect('*/*/');
		}

		// load story and delete it
		try {
			$story = Mage::getModel('gugliotti_news/story')->load($storyId);
			$story->delete();
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected story was successfully deleted'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when deleting this entry. Please, try again'));
		}
		return $this->_redirect('*/*/');
	}

	/**
	 * massDeleteAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function massDeleteAction()
	{
		$storiesIds = $this->getRequest()->getParam('stories');
		if (!is_array($storiesIds)) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('You must select at least one story to be deleted.'));
			return $this->_redirect('*/*/');
		}

		// delete stories
		try {
			foreach ($storiesIds as $id) {
				$story = Mage::getModel('gugliotti_news/story')->load($id);
				$story->delete();
			}
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected stories were successfully deleted'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when deleting some selected stories. Please, try again'));
		}

		return $this->_redirect('*/*/');
	}

	/**
	 * massStatusAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function massStatusAction()
	{
		$storiesIds = $this->getRequest()->getParam('stories');
		if (!is_array($storiesIds)) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('You must select at least one story to be updated.'));
			return $this->_redirect('*/*/');
		}

		// update stories status
		try {
			foreach ($storiesIds as $id) {
				$story = Mage::getModel('gugliotti_news/story')->load($id);
				$story->setStatus($this->getRequest()->getParam('status'));
//				$story->setIsMassUpdate(true); // useful when updating indexed entities
				$story->save();
			}
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected stories were successfully updated'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when updating some selected stories. Please, try again'));
		}

		return $this->_redirect('*/*/');
	}

	/**
	 * exportCsvAction
	 */
	public function exportCsvAction()
	{
		$filename = 'news_stories.csv';
		$content = $this->getLayout()->createBlock('gugliotti_news/adminhtml_story_grid')->getCsv();
		$this->_sendDownloadResponse($filename, $content);
	}

	/*
	 * exportXmlAction
	 */
	public function exportXmlAction()
	{
		$filename = 'news_stories.xml';
		$content = $this->getLayout()->createBlock('gugliotti_news/adminhtml_story_grid')->getXml();
		$this->_sendDownloadResponse($filename, $content);
	}

	/**
	 * _sendDownloadResponse
	 * @param string $filename
	 * @param string $content
	 * @param string $contentType
	 */
	protected function _sendDownloadResponse($filename, $content, $contentType = 'application/octet-stream')
	{
		$response = $this->getResponse();
		$response->setHeader('HTTP/1.1 200 OK', '');
		$response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
		$response->setHeader('Content-Disposition', 'attachment; filename = ' . $filename);
		$response->setHeader('Last-Modified', date('r'));
		$response->setHeader('Accept-Ranges', 'bytes');
		$response->setHeader('Content-Length', strlen($content));
		$response->setHeader('Content-Type', $contentType);
		$response->setBody($content);
		$response->sendResponse();
	}

	/**
	 * _isAllowed
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('gugliotti_news');
	}
}
