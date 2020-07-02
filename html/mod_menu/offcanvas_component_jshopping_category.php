<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('ModFlJShopCatsHelper', JPATH_ROOT . '/modules/mod_fljshoppingcats/helper.php');

// var_dump($item);
$catid = $item->query['category_id'] ? $item->query['category_id'] : 0;
$cats = ModFlJShopCatsHelper::getAllCats(null);

// var_dump($cats);

$attributes = array();

if(!function_exists('recursiveCatsOffcanvas'))
{
	function recursiveCatsOffcanvas(&$cats, $id)
	{
		static $level = 0;
		
		$html = $level ? '<ul class="fl-level-'.($level + 1).'">' : '<ul class="uk-nav-sub">';
		
		foreach($cats[$id] as $cat)
		{
			if($cats[$cat->id])
			{
				$html .= $cat->active ? '<li class="uk-parent uk-active">' : '<li class="uk-parent">';
				
				$html .= JHtml::link($cat->link, $cat->name, 'class="fl-link"');
				// $html .= JHtml::link('#', '', 'class="fl-toggle"');
				
				if($cat->active)
				{
					$level++;
					$html .= recursiveCatsOffcanvas($cats, $cat->id);
					$level--;
				}
			}
			else
			{
				$html .= $cat->active ? '<li class="uk-active">' : '<li>';
				$html .= JHtml::link($cat->link, $cat->name, 'class="fl-link"');
			}
			
			$html .= '</li>';
		}
		
		return $html . '</ul>';
	}
}


if ($item->anchor_title)
{
	$attributes['title'] = $item->anchor_title;
}
if ($item->anchor_css)
{
	$attributes['class'] = $item->anchor_css;
}
if ($item->anchor_rel)
{
	$attributes['rel'] = $item->anchor_rel;
}

$linktype = $item->title;

if ($item->menu_image)
{
	if ($item->menu_image_css)
	{
		$image_attributes['class'] = $item->menu_image_css;
		$linktype = JHtml::_('image', $item->menu_image, $item->title, $image_attributes);
	}
	else
	{
		$linktype = JHtml::_('image', $item->menu_image, $item->title);
	}

	if ($item->params->get('menu_text', 1))
	{
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

if ($item->browserNav == 1)
{
	$attributes['target'] = '_blank';
}
else if($item->browserNav == 2)
{
	$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes';

	$attributes['onclick'] = "window.open(this.href, 'targetWindow', '" . $options . "'); return false;";
}

if(count($cats))
{
	$classes[] = 'uk-parent';
	
	$item_result .= JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
	
	
	$item_result .= recursiveCatsOffcanvas($cats, 0);
	
	
}
else
{
	$item_result .= JHtml::_('link', JFilterOutput::ampReplace(htmlspecialchars($item->flink, ENT_COMPAT, 'UTF-8', false)), $linktype, $attributes);
}
