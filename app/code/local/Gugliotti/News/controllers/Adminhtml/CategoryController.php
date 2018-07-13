<?php
/**
 * Gugliotti_News_Controller_Adminhtml_CategoryController
 */

/**
 * Class Gugliotti_News_Controller_Adminhtml_CategoryController
 *
 * Adminhtml controller for managing categories.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
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
		if ($this->getRequest()->getParam('category_id')) {
			$model = Mage::getModel('gugliotti_news/category')
                ->load($this->getRequest()->getParam('category_id'));
			if (!$model || !$model->getId()) {
				Mage::getSingleton('adminhtml/session')
                    ->addError($this->__('There was an error when loading the category. Please, try again.'));
				return $this->_redirect('*/*/');
			}
		} else {
			$model = Mage::getModel('gugliotti_news/category');
		}

		// prepare data to be saved
		$code = $this->getRequest()->getPost('code');
		$label = $this->getRequest()->getPost('label');

		if (!$code || !$label) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('A required field was not informed. Please, verify your form.'));
			return $this->_redirect('*/*/');
		}

		// save data
		try {
			$model->setCode($code);
			$model->setLabel($label);
			$model->setStatus($this->getRequest()->getPost('status'));
			$model->save();
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The category was successfully saved'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when saving the category. Please, try again'));
		}

		// redirect to edit page if Save and Continue was used
		if ($this->getRequest()->getParam('back') && $this->getRequest()->getParam('back') == 'edit') {
			return $this->_redirect('*/*/edit', array('category_id' => $model->getId()));
		}
		return $this->_redirect('*/*/');
	}

	/**
	 * deleteAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function deleteAction()
	{
		// get category ID
		$categoryId = $this->getRequest()->getParam('category_id');
		if (!$categoryId) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when deleting this entry. Please, try again'));
			return $this->_redirect('*/*/');
		}

		// load category and delete it
		try {
			$category = Mage::getModel('gugliotti_news/category')->load($categoryId);
			$category->delete();
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected category was successfully deleted'));
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
		$categoriesIds = $this->getRequest()->getParam('categories');
		if (!is_array($categoriesIds)) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('You must select at least one category to be deleted.'));
			return $this->_redirect('*/*/');
		}

		// delete categories
		try {
			foreach ($categoriesIds as $id) {
				$category = Mage::getModel('gugliotti_news/category')->load($id);
				$category->delete();
			}
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected categories were successfully deleted'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when deleting some selected categories. Please, try again'));
		}

		return $this->_redirect('*/*/');
	}

	/**
	 * massStatusAction
	 * @return $this|Mage_Core_Controller_Varien_Action
	 */
	public function massStatusAction()
	{
		$categoriesIds = $this->getRequest()->getParam('categories');
		if (!is_array($categoriesIds)) {
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('You must select at least one category to be updated.'));
			return $this->_redirect('*/*/');
		}

		// update categories status
		try {
			foreach ($categoriesIds as $id) {
				$category = Mage::getModel('gugliotti_news/category')->load($id);
				$category->setStatus($this->getRequest()->getParam('status'));
//				$category->setIsMassUpdate(true); // useful when updating indexed entities
				$category->save();
			}
			Mage::getSingleton('adminhtml/session')
                ->addSuccess($this->__('The selected categories were successfully updated'));
		} catch (Exception $e) {
			Mage::logException($e);
			Mage::getSingleton('adminhtml/session')
                ->addError($this->__('There was an error when updating some selected categories. Please, try again'));
		}

		return $this->_redirect('*/*/');
	}

	/**
	 * exportCsvAction
	 */
	public function exportCsvAction()
	{
		$filename = 'news_categories.csv';
		$content = $this->getLayout()->createBlock('gugliotti_news/adminhtml_category_grid')->getCsv();
		$this->_sendDownloadResponse($filename, $content);
	}

	/*
	 * exportXmlAction
	 */
	public function exportXmlAction()
	{
		$filename = 'news_categories.xml';
		$content = $this->getLayout()->createBlock('gugliotti_news/adminhtml_category_grid')->getXml();
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
