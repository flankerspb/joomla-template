<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

function pagination_list_render($list) {

	// find out the id of the page, that is the current page
	$currentId = 0;
	foreach ($list['pages'] as $id => $page) {
		if (!$page['active']) {
			$currentId = $id;
		}
	}

	// set the range for the inner pages that should be displayed
	// this displays + - $range page-buttons arround the current page
	// due to joomla-restrictions there won't be displayed more than -5 and +4 buttons.
	$range = 3;

	// start building pagination-list
	$html = array('<ul class="uk-pagination">');

	// add first-button
	// if ($list['start']['active'] == 1) {
		$html[] = $list['start']['data'];
	// }

	// add previous-button
	// if ($list['previous']['active'] == 1) {
		$html[] = $list['previous']['data'];
	// }


	// add buttons for sourrounding pages
	foreach ($list['pages'] as $id => $page) {
		// only show the buttons that are within the range
		if ($id <= $currentId+$range && $id >= $currentId-$range) {
			$html[] = $page['data'];
		}
	}

	// add next-button
	// if ($list['next']['active'] == 1) {
		$html[] = $list['next']['data'];
	// }

	// add last-button
	// if ($list['end']['active'] == 1) {
		$html[] = $list['end']['data'];
	// }

	// close pagination-list
	$html[] = "</ul>";

	return implode("\n", $html);
}

function pagination_item_active($item)
{
	$itemClass = '';
	$linkClass = '';
	$title = '';

	if ($item->text == JText::_('JNEXT'))
	{
		$item->text = '<i class="uk-icon-angle-right"></i>';
		$linkClass = 'next';
		$title = JText::_('JNEXT');
	}
	else if ($item->text == JText::_('JPREV'))
	{
		$item->text = '<i class="uk-icon-angle-left"></i>';
		$linkClass = 'previous';
		$title = JText::_('JPREV');
	}
	else if ($item->text == JText::_('JLIB_HTML_START'))
	{
		$item->text = '<i class="uk-icon-angle-double-left"></i>';
		$linkClass = 'first';
		$title = JText::_('JLIB_HTML_START');
	}
	else if ($item->text == JText::_('JLIB_HTML_END'))
	{
		$item->text = '<i class="uk-icon-angle-double-right"></i>';
		$linkClass = 'last';
		$title = JText::_('JLIB_HTML_END');
	}
	else
	{
		$itemClass = 'uk-hidden-small';
	}

	return '<li class="'.$itemClass.'"><a class="'.$linkClass.'" href="'.$item->link.'" title="'.$title.'">'.$item->text.'</a></li>';
}

function pagination_item_inactive(&$item)
{
	$itemClass = 'uk-active';
	
	if ($item->text == JText::_('JNEXT'))
	{
		$item->text = '<i class="uk-icon-angle-right"></i>';
		$itemClass = 'uk-disabled';
	}
	else if ($item->text == JText::_('JPREV'))
	{
		$item->text = '<i class="uk-icon-angle-left"></i>';
		$itemClass = 'uk-disabled';
	}
	else if ($item->text == JText::_('JLIB_HTML_START'))
	{
		$item->text = '<i class="uk-icon-angle-double-left"></i>';
		$itemClass = 'uk-disabled';
	}
	else if ($item->text == JText::_('JLIB_HTML_END'))
	{
		$item->text = '<i class="uk-icon-angle-double-right"></i>';
		$itemClass = 'uk-disabled';
	}
	
	return '<li class="'.$itemClass.'"><span>'.$item->text.'</span></li>';
}




