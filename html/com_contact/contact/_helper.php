<?php

defined('_JEXEC') or die;

class flContactHelper
{
	public $phoneRegExp = "~[^\d\+]~";
	
	public static function address($value, $prop, $show, $class = '')
	{
		static $i = false;
		
		$props = [
			'postcode' => 'postalCode',
			'country' => 'addressCountry',
			'state' => 'addressRegion',
			'suburb' => 'addressLocality',
			'address' => 'streetAddress',
		];
		
		$prop = ' itemprop="'.$props[$prop].'"';
		
		if($show)
		{
			$prefix = $i ? ', ' : '';
			
			$i = true;
			
			$class = $class ? ' class="'.$class.'"' : '';
			
			return $prefix . '<span' . $class . $prop . '>' . $value . '</span>';
		}
		else
		{
			return '<meta ' . $prop . ' content="' . $value . '" />';
		}
	}
	
	public static function phone($value, $prop, $show, $class)
	{
		
		
		return;
	}
}
