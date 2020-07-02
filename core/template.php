<?php
/**
 * @package     2sweb
 * @subpackage  Templates.2sweb
 *
 * @copyright   Copyright (C) 2018 Vitaliy Moskalyuk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;


class FlTemplate
{
	public static $scripts = array();
	public static $styles = array();
	
	public static $isHome;
	
	public static $app;
	public static $lang;
	public static $doc;
	public static $params;
	public static $prefix;
	public static $menu;
	public static $activeMenu;
	public static $modules;
	
	
	
	
	public static function __callStatic($method, $args)
	{
		static $init = false;
		
		if(!$init)
		{
			$init = true;
			
			self::$app = JFactory::getApplication();
			self::$lang = self::$app->getLanguage();
			self::$menu = self::$app->getMenu();
			self::$activeMenu = self::$menu->getActive();
			
			self::$doc = self::$app->getDocument();
			self::$doc->setLanguage(self::$lang->getTag());
			
			self::$params = self::$doc->params;
			self::$prefix = self::$doc->params->get('prefix');
			
			//set scripts arrays
			self::$doc->com_scripts = array();
			self::$doc->mod_scripts = array();
			self::$doc->plg_scripts = array();
			
			self::$isHome = self::isHome();
		}
		
		// return self::$method($args);
		return call_user_func_array(__CLASS__ . '::' . $method, $args);
	}
	
	protected static function getInputClass($prefix = '')
	{
		$result = array();
		
		if($prefix)
		{
			$prefix .= '-';
		}
		else if(self::$prefix)
		{
			$prefix = self::$prefix . '-';
		}
		else
		{
			$prefix = '';
		}
		
		$input = self::$app->input->getArray();
		
		
		if(isset($input['option']))
		{
			$result['option'] = $prefix . substr($input['option'], 4);
			
			if(isset($input['view']))
			{
				$result['option'] .= $input['view'];
			}
		}
		
		if(isset($input['layout']))
		{
			$result['layout'] = $prefix . 'layout-' . end(explode(':', $input['layout']));
		}
		
		if($input['Itemid'] && is_object(self::$activeMenu))
		{
			$result['alias'] = str_replace('-', '_', $prefix . self::$activeMenu->alias);
			if(self::$activeMenu->alias != self::$activeMenu->route)
			{
				$result['route'] = $prefix . str_replace('/', '-', str_replace('-', '_', self::$activeMenu->route));
			}
		}
		
		return implode(' ', $result);
	}
	
	protected static function getPageAttribs()
	{
		$result = array();
		
		$result['lang'] = self::$doc->language;
		$result['dir'] = self::$doc->direction;
		// $result['data-config'] = self::$params->get('html_config');
		
		$result = array_map
		(
			function ($v, $k) {if($v) return $k . '="' . $v . '"';},
			$result,
			array_keys($result)
		);
		
		return implode(' ', $result);
	}
	
	protected static function getPageClasses()
	{
		$result = array();
		
		$result[] = str_replace('-', ' ', self::$doc->language);
		$result[] = self::$doc->direction;
		
		if(is_array(self::$doc->params->get('html_slasses')))
		{
			$result += self::$doc->params->get('html_slasses');
		}
		
		if(is_object(self::$activeMenu))
		{
			if($sfx = trim(self::$activeMenu->params->get('pageclass_sfx')))
			{
				$result[] = $sfx;
			}
		}
		
		if(self::$isHome)
		{
			$result[] = 'home';
		}
		
		return implode(' ', $result);
	}
	
	protected static function isHome()
	{
		if(!self::$activeMenu->home)
		{
			return self::$doc->isHome = false;
		}
		
		if(JLanguageMultilang::isEnabled())
		{
			$home = self::$menu->getDefault(self::$lang->getTag());
		}
		else
		{
			$home = self::$menu->getDefault();
		}
		
		$home_url = trim(parse_url(JRoute::_('index.php?Itemid=' . $home->id, true, -1), PHP_URL_PATH), '/');
		$current_url = trim(parse_url(Juri::current(), PHP_URL_PATH), '/');
		$base_url = trim(parse_url(Juri::base(), PHP_URL_PATH), '/');

		self::$doc->isHome = $current_url == $home_url || $current_url == $base_url;
		
		return self::$doc->isHome;
	}
	
	public static function addScript($url, $options = array(), $attribs = array())
	{
		self::$scripts[$url] = ['options' => $options, 'attribs' => $attribs];
	}
	
	public static function setScripts()
	{
		foreach(self::$scripts as $url => $script)
		{
			JHtml::_('script', $url, $script['options'], $script['attribs']);
		}
	}
	
	public static function addStyle($url, $options = array(), $attribs = array())
	{
		self::$styles[$url] = ['options' => $options, 'attribs' => $attribs];
	}
	
	public static function setStyles()
	{
		foreach(self::$styles as $url => $style)
		{
			JHtml::_('stylesheet', $url, $style['options'], $style['attribs']);
		}
	}
}
