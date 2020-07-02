<?php

defined('_JEXEC') or die;

if(!$this->dropdown_menu)
	$this->dropdown_menu = $this->categories_menu;

foreach ($this->dropdown_menu as $item)
{
	if(in_array($item->id, $this->exclude_cats))
	{
		continue;
	}
	
	$title = $item->note ? $item->note : $item->title;
	
	$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
	
	$link_attribs = array();
	
	$class = array();
	
	if(!$this->categories_menu_level)
	{
		$link_attribs['class'] = 'uk-text-bold';
	}
	
	if($item->id == $this->parent->id)
	{
		$class[] = 'uk-active';
	}
	
	$children = '';
	
	if($item->hasChildren())
	{
		$class[] = 'uk-parent';
		
		$this->categories_menu_level++;
		$this->dropdown_menu = $item->getChildren();
		$children = $this->loadTemplate('dropdown');
		$this->categories_menu_level--;
	}
	
	$link = JHtml::link($url, '<span>' . $title . '</span>', $link_attribs);
	
	$tag = $class ? '<li class="' . implode(' ', $class) . '">' : '<li>';
	
	echo $tag . $link . '</li>' . $children;
}
