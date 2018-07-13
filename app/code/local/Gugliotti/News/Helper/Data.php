<?php
/**
 * Gugliotti_News_Helper_Data
 */

/**
 * Class Gugliotti_News_Helper_Data
 *
 * Gugliotti News Main Helper.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * constants
	 */
	const NEWS_MEDIA_FOLDER = 'news';

	/**
	 * getConfigData
	 *
	 * Returns configuration value for a given key.
	 * @param string $code
	 * @return mixed
	 */
	public function getConfigData($code)
	{
		return Mage::getStoreConfig('gugliotti_news/' . $code);
	}

	/**
	 * getMediaFolder
	 *
	 * Returns news folder, relative to media folder.
	 * @return string
	 */
	public function getMediaFolder()
	{
		return self::NEWS_MEDIA_FOLDER;
	}

	/**
	 * getImageFullPath
	 *
	 * Returns the full image path for a given file name
	 * @param string $filePath
	 * @return string
	 */
	public function getImageFullPath($filePath)
	{
		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->getMediaFolder() . DS . $filePath;
	}

	/**
	 * summarize
	 *
	 * Returns the first X character for a given string.
	 * @param string $string
	 * @param int $length
	 * @return string
	 */
	public function summarize($string, $length = 250)
	{
		$string = str_split($string, $length);
		return $string[0] . ' ...';
	}

	/**
	 * deleteImage
	 *
	 * Delete a image from media folder, when configuration is set to 1.
	 * @param string $thumbnailName
	 * @param string $filePath
	 * @return bool
	 */
	public function deleteImage($thumbnailName, $filePath = null)
	{
		if (!$filePath) {
			$filePath = self::NEWS_MEDIA_FOLDER;
		}

		if ($this->getConfigData('delete_images')) {
			$fullPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $filePath . DS . $thumbnailName;
			if (file_exists($fullPath)) {
				try {
					unlink($fullPath);
				} catch (Exception $e) {
					Mage::logException($e);
					return false;
				}
			} else {
				Mage::log(
				    __CLASS__ .
                    ': a not valid path was passed to the method, the file was not found. Full path: '
                    . $fullPath
                );
				return false;
			}
		}
		return true;
	}
}
