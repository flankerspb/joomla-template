<?php 
/**
* @version	  4.8.0 18.08.2013
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

$config_fields = $this->config_fields;

$input = Jfactory::getApplication()->input->getArray();

// var_dump($input);

include(dirname(__FILE__)."/editaccount.js.php");

if(array_key_exists('password', $input))
{
	include(dirname(__FILE__)."/editaccount_password.php");
}
else if(array_key_exists('delivery', $input))
{
	include(dirname(__FILE__)."/editaccount_delivery.php");
}
else
{
	include(dirname(__FILE__)."/editaccount_default.php");
}
