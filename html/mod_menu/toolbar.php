<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id = '';

$result = '<nav><ul class="uk-subnav uk-subnav-line">';

if($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}



// var_dump($id);

// The menu class is deprecated. Use nav instead

// var_dump($list);


// <ul class="nav menu<?php echo $class_sfx;  mod-list"<?php echo $id; >

$dropdown = '<div class="uk-dropdown uk-dropdown-small">';

foreach ($list as $i => &$item)
{
	$item_result = '';
	
	$attribs = array();
	$classes = array();
	
	if($item->id == $default_id)
	{
		$classes[] = 'uk-home';
		// $item->type = 'home';
	}
	
	if($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$classes[] = 'uk-current';
	}
	
	if(in_array($item->id, $path))
	{
		$classes[] = 'uk-active';
	}
	elseif($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if(count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$classes[] = 'uk-active';
		}
		elseif(in_array($aliasToId, $path))
		{
			$classes[] = 'uk-active uk-parent uk-alias';
		}
	}
	
	if($item->type === 'separator')
	{
		$classes[] = 'uk-divider';
	}
	
	if($item->deeper)
	{
		$classes[] = 'uk-deeper';
		
		if($item->level == 1)
		{
			$attribs[] = 'data-uk-dropdown="{pos:\'bottom-right\'}"';
		}
	
	}
	if($item->parent)
	{
		$classes[] = 'uk-parent';
		
	}
	
	switch ($item->type)
	{
		case 'separator':
		case 'component':
		case 'heading':
		case 'home':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;
		
		// case 'component':
			// switch ($item->component)
			// {
				// case 'com_jshopping':
					// require JModuleHelper::getLayoutPath('mod_menu', 'default_component_' . substr($item->query['option'], 4) . '_' . $item->query['view']);
					// break;
				// default:
					// require JModuleHelper::getLayoutPath('mod_menu', 'default_component');
					// break;
			// }
			// break;
		
		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	}
	
	$class =  ' class="' . implode(' ', $classes) . '"';
	$attrib = ' ' . implode(' ', $attribs);
	
	$result .= '<li' . $class . $attrib . '>';
	$result .= $item_result;
	
	// The next item is deeper.
	if($item->deeper)
	{
		if($item->level == 1)
		{
			$result .= $dropdown . '<ul class="uk-nav uk-nav-dropdown">';
		}
		else
		{
			$result .= '<ul class="fl-level-'.$item->level.'">';
		}
	}
	// The next item is shallower.
	else if($item->shallower)
	{
		$result .= '</li>';
		
		if($item->level == 1)
		{
			$result .= str_repeat('</ul></div></li>', $item->level_diff);
		}
		else
		{
			$result .= str_repeat('</ul></li>', $item->level_diff);
		}
	}
	// The next item is on the same level.
	else
	{
		$result .= '</li>';
	}
}

echo $result .'</ul></nav>';
