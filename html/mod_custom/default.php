<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$class = '';

if($moduleclass_sfx)
	$class = ' class="' . $moduleclass_sfx . '"';

$bg_image = $params->get('backgroundimage', '');

if($bg_image)
	$bg_image = ' style="background-image:url(' . $bg_image . ')"';


echo '<div' . $class . $bg_image . '>' . $module->content . '</div>';
