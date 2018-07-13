<?php
/**
 * Gugliotti_News_Helper_Log
 */

/**
 * Class Gugliotti_News_Helper_Log
 *
 * Gugliotti News Log Helper.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.3.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Helper_Log extends Mage_Core_Helper_Abstract
{
	/**
	 * log
	 *
	 * Module custom log routine.
	 * @param string $message
	 * @param integer $level
	 * @param string $logFile
	 * @return bool
	 */
	public function log($message, $level = 7, $logFile = '')
	{
		// control if log is enabled for this module
		if (!Mage::helper('gugliotti_news')->getConfigData('log/log_enabled')) {
			return false;
		}

		// define log file
		if (Mage::helper('gugliotti_news')->getConfigData('log/log_file')) {
			$logFile = Mage::helper('gugliotti_news')->getConfigData('log/log_file');
		}

		// log message
		Mage::log($message, $level, $logFile);
		return true;
	}
}
