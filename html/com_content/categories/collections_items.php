<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang  = JFactory::getLanguage();

$exclude = $this->params->get('exclude_cats', array());

$position = 1;

foreach ($this->items[$this->parent->id] as $id => $item)
{
	$children = $item->getChildren();
	
	if(count($exclude))
	{
		foreach ($children as $k => $child)
		{
			if(in_array($child->id, $exclude))
			{
				unset($children[$k]);
			}
		}
	}
	
	$this->items[$item->id] = $children;
	$this->parent = $item;
	$this->maxLevelcat--;
	
	if($this->items[$item->id])
	{
		$div = '<div class="fl-collection-group" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><meta itemprop="position" content="'.$position.'"><div itemprop="item" itemscope itemtype="https://schema.org/ItemList">';
		
		$title = '<h2 class="uk-margin-remove" itemprop="name">' . $this->escape($item->title) . '</h2>';
		
		$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
		
		$link_attribs = array();
		$link_attribs['itemprop'] = 'url';
		
		$title = JHtml::link($url, $title, $link_attribs);
		
		$position++;
	}
	else
	{
		$div = '<div>';
		
		$title = '<h2 class="uk-margin-remove uk-text-muted">' . $this->escape($item->title) . '</h2>';
		
	}
	
	echo $div . '<div class="uk-margin-large-top">' . $title . '</div>';
	
	
	echo $this->loadTemplate('children');
	$this->parent = $item->getParent();
	$this->maxLevelcat++;
	
	echo '</div></div>';
}

