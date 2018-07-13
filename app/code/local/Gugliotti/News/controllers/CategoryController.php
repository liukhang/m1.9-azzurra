<?php
/**
 * Gugliotti_News_Controller_CategoryController
 */

/**
 * Class Gugliotti_News_Controller_CategoryController
 *
 * Controller for news categories pages.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_CategoryController extends Mage_Core_Controller_Front_Action
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
		$this->loadLayout();
		$this->renderLayout();
	}
}
