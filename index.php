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

define('TEMPLATE_PATH', JPATH_ROOT . '/templates/2sweb');

$app = JFactory::getApplication();

// if(!$app->input->get('Itemid'))
// {
	// $this->error = new Exception('URL was not found', 404);
	// header("HTTP/1.0 404 Not Found");
	// require('error.php');
	// exit();
// }
// else if($app->get('sef') && !empty($_GET))
// {
	// $restricted = array('option' => 0, 'view' => 0, 'layout' => 0, 'Itemid' => 0);
	
	// if(count(array_intersect_key($_GET,$restricted)))
	// {
		// $this->error = new Exception('URL was not found', 404);
		// header("HTTP/1.0 404 Not Found");
		// require('error.php');
		// exit();
	// }
// }

// set helper
JLoader::register('FlTemplate', TEMPLATE_PATH . '/core/template.php');

?>
<!DOCTYPE html>
<html <?php echo FlTemplate::getPageAttribs(); ?> class="<?php echo FlTemplate::getPageClasses(); ?>">
<?php require('index.head.php'); ?>
<?php require('index.body.php'); ?>
</html>
