<?php
/**
 * Gugliotti News Setup
 */

/**
 * Gugliotti News Installer
 *
 * Gugliotti News Data Installer.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.2.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */

// categories sample data array
$categoryData = array(
	array(
		'code' => 'sample1',
		'label' => 'Sample 1',
	),
	array(
		'code' => 'sample2',
		'label' => 'Sample 2',
	),
	array(
		'code' => 'sample3',
		'label' => 'Sample 3',
	),
);

// create categories
$categoryId = 1;
foreach ($categoryData as $ca) {
	try {
		$category = Mage::getModel('gugliotti_news/category');
		$category->setCode($ca['code']);
		$category->setLabel($ca['label']);
		$category->save();
		$categoryId = $category->getId();
	} catch (Exception $e) {
		Mage::logException($e);
	}
}

// stories sample data array
$storiesData = array(
	array(
		'title' => 'Sample Story 1',
		'content' => '<p>This is a sample content for a sample story</p>',
	),
	array(
		'title' => 'Sample Story 2',
		'content' => '<p>This is a sample content for a sample story</p>',
	),
	array(
		'title' => 'Sample Story 3',
		'content' => '<p>This is a sample content for a sample story</p>',
	),
);

// create stories
foreach ($storiesData as $st) {
	try {
		$story = Mage::getModel('gugliotti_news/story');
		$story->setTitle($st['title']);
		$story->setContent($st['content']);
		$story->setCategoryId($categoryId);
		$story->save();
	} catch (Exception $e) {
		Mage::logException($e);
	}
}
