<?php
/**
 * Gugliotti_News_Controller_StoryController
 */

/**
 * Class Gugliotti_News_Controller_StoryController
 *
 * Controller for news stories pages.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_StoryController extends Mage_Core_Controller_Front_Action
{
	/**
	 * indexAction
	 */
	public function indexAction()
	{
		$this->_forward('list');
	}

	/**
	 * listAction
	 */
	public function listAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	/**
	 * viewAction
	 */
	public function viewAction()
	{
		// redirect if no story is informed
		if (!$this->getRequest()->getParam('id')) {
			$this->_redirect('news/story');
		}

		$this->loadLayout();
		$this->renderLayout();
	}
}
