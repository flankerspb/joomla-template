<?php
/**
 * @package     2sweb
 * @subpackage  Templates.2sweb
 *
 * @copyright   Copyright (C) 2018 Vitaliy Moskalyuk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined( '_JEXEC' ) or die;

jimport('joomla.form.formfield');

class JFormFieldFormHelper extends JFormField
{

	protected $type = 'Formhelper';

	public function getInput()
	{
		
		
		// $layout = new JLayoutFile('joomla.content.tags', __DIR__ . '/lay/com_mycomponent/layouts'); 
		
		// var_dump($layout);
	}
	public function getOptions()
	{
		// return print_r($this->element);
	}
	public function getLabel()
	{		
		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::root() . 'modules/mod_flminigallery/assets/css/backend.css');
		$document->addScript(JUri::root() . 'modules/mod_flminigallery/assets/js/backend.js');
		
		$debug = (string)$this->element['debug'];
		
		if ($debug) {
			echo '<pre>';
			print_r($this->element);
			echo '</pre>';
			
			echo '<pre>';
			print_r($this);
			echo '</pre>';
		}
		
		return;
	}
}
