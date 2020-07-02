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

// Debug mode
if($this->params->get('dev_mode', '1'))
{
	$this->setMediaVersion(uniqid());
	$debug = true;
}
else
{
	$this->setMediaVersion('');
	$debug = false;
}

// Output as HTML5
if ($this->getType() == 'html')
{
	$this->setHtml5(true);
	$this->setMetaData('X-UA-Compatible', 'IE=edge', 'http-equiv');
	// $this->setMetaData('viewport', 'initial-scale=1,minimum-scale=1,maximum-scale=1,width=device-width');
	$this->setMetaData('viewport', 'initial-scale=1,width=device-width');
	$this->setBase(htmlspecialchars(JUri::current()));
}

// Unset generator
if($this->_generator)
{
	$this->setGenerator('');
}

// Set creator
$this->setMetadata('creator', '2sweb.ru');


//Unset scripts
switch($this->params->get('unset_scripts', '2'))
{
	case '1' :
		if(array_key_exists('/media/jui/js/jquery-noconflict.js', $this->_scripts))
		{
			unset($this->_scripts['/media/jui/js/jquery-noconflict.js']);
		}
		if(array_key_exists('/media/jui/js/jquery-migrate.min.js', $this->_scripts))
		{
			unset($this->_scripts['/media/jui/js/jquery-migrate.min.js']);
		}
		break;
	case '2' :
		$this->_scripts = array();
		break;
}

// Add JavaScript Frameworks
if($this->params->get('load_jquery', '1'))
{
	JHtml::_('script', 'jui/jquery.min.js', array('version' => 'auto', 'relative' => true, 'detectDebug' => $debug));
}

// Add js
JHtml::_('script', 'uikit.js', array('version' => 'auto', 'relative' => true));
// JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'custom.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'theme.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'shopping.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'uikit/sticky.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'uikit/notify.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'system/core.js', array('version' => 'auto', 'relative' => true));

//Load scripts from layouts
FlTemplate::setScripts();

// Add Stylesheets
// JHtml::_('stylesheet', 'bootstrap.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'theme.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'custom.css', array('version' => 'auto', 'relative' => true));


// Add languege constants
JText::script('ERROR');
JText::script('MESSAGE');
JText::script('NOTICE');
JText::script('WARNING');

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));


// Load optional RTL Bootstrap CSS
// JHtml::_('bootstrap.loadCss', false, $this->direction);

?>
<head><jdoc:include type="head" /></head>