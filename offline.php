<?php
/**
 * @package     2sweb
 * @subpackage  Templates.2sweb
 *
 * @copyright   Copyright (C) 2014 - 2019 Vitaliy Moskalyuk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$twofactormethods = JAuthenticationHelper::getTwoFactorMethods();

// Output as HTML5
if ($this->getType() == 'html')
{
	$this->setHtml5(true);
	$this->setMetaData('X-UA-Compatible', 'IE=edge', 'http-equiv');
	$this->setMetaData('viewport', 'initial-scale=1,width=device-width');
	$this->setBase(htmlspecialchars(JUri::current()));
}

// Unset generator
if($this->_generator)
{
	$this->setGenerator('');
}

//Unset scripts
if($this->_scripts)
{
	$this->_scripts = array();
}

JHtml::stylesheet('theme.css', array('version' => 'auto', 'relative' => true));

$title = JText::_('TPL_2SWEB_PAGE_OFFLINE_TITLE');

switch($app->get('display_offline_message', 1))
{
	case 1:
		$message = trim($app->get('offline_message'));
		break;
	case 2:
		$message = JText::_('JOFFLINE_MESSAGE');
		break;
		
	default:
		$message = '';
}

$showOfflineForm = $this->params->get('show_offline_form', 0);
$showOfflineImage = $this->params->get('show_offline_image', 1);

if($showOfflineImage)
{
	$image = $app->get('offline_image');
	
	$image = $image ? JHtml::image($image, $app->get('sitename')) : '<i class="tm-error-icon uk-icon-frown-o"></i>';
}

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" class="uk-height-1-1 offline">
<head>
	<jdoc:include type="head" />
</head>
<body class="uk-height-1-1 uk-flex uk-flex-middle uk-text-center">
	<div class="tm-offline uk-panel uk-panel-box uk-vertical-align-middle uk-container-center">
		<jdoc:include type="message" />
		<?php if($showOfflineImage) : ?>
			<?php echo $image; ?>
		<?php endif; ?>
		<h1 class="uk-h3"><?php echo $title; ?></h1>
		<?php if($message) : ?>
			<p><?php echo $message; ?></p>
		<?php endif; ?>
		<?php if($showOfflineForm) : ?>
			<form class="uk-form" action="<?php echo JRoute::_('index.php', true); ?>" method="post">
				<div class="uk-form-row">
					<input class="uk-width-1-1" type="text" name="username" placeholder="<?php echo JText::_('JGLOBAL_USERNAME') ?>">
				</div>
				<div class="uk-form-row">
					<input class="uk-width-1-1" type="password" name="password" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
				</div>
				<?php if(count($twofactormethods) > 1) : ?>
				<div class="uk-form-row">
					<input class="uk-width-1-1" type="text" name="secretkey" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
				</div>
				<?php endif; ?>
				<div class="uk-form-row">
					<button class="uk-button uk-button-primary uk-width-1-1" type="submit" name="Submit"><?php echo JText::_('JLOGIN') ?></button>
				</div>
				<div class="uk-form-row">
					<div class="uk-form-controls">
						<input type="checkbox" name="remember" value="yes" placeholder="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>">
						<label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
					</div>
				</div>
				<input type="hidden" name="option" value="com_users">
				<input type="hidden" name="task" value="user.login">
				<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>">
				<?php echo JHtml::_('form.token'); ?>
			</form>
		<?php endif; ?>
	</div>
</body>
</html>
