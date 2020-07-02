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

switch(get_class($this->error))
{
	case 'ParseError':
	case 'Error':
	// Default:
		if(isset($this->error->xdebug_message))
		{
			echo '<table>' . $this->error->xdebug_message . '</table>';
			exit();
		}
		break;
}

//var_dump($this->error);

$error = $this->error->getCode();
$notice = JText::_('TPL_2SWEB_PAGE_NOTICE_ERROR');

switch($error)
{
	case 404:
		$title = JText::_('TPL_2SWEB_PAGE_TITLE_ERROR_' . $error);
		$message = JText::_('TPL_2SWEB_PAGE_MESSAGE_ERROR_' . $error);
		break;
	default:
		$title = JText::_('TPL_2SWEB_PAGE_TITLE_ERROR');
		$message = JText::_('TPL_2SWEB_PAGE_MESSAGE_ERROR');
}

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="uk-height-1-1 tm-error">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $error . ' - ' . $title; ?></title>
	<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
	<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon.png">
	<link rel="stylesheet" href="/templates/2sweb/css/theme.css">
</head>
<body class="uk-height-1-1 uk-vertical-align uk-text-center">
	<div class="uk-vertical-align-middle uk-container-center">
		<i class="tm-error-icon uk-icon-frown-o"></i>
		<h1 class="tm-error-headline"><?php echo $error; ?></h1>
		<h2 class="uk-h3 uk-text-muted"><?php echo $title; ?></h2>
		<p><?php echo $message; ?><br><?php echo $notice; ?></p>
	</div>
</body>
</html>







