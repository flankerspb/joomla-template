<?php 
/**
* @version      4.17.1 30.03.2018
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php
$config_fields = $this->config_fields;
include(dirname(__FILE__)."/register.js.php");
?>
<div class="jshop" id="comjshop_register">
	<h1 class="uk-text-center"><?php print _JSHOP_REGISTRATION;?></h1>
	
	<div>
		<form
				class="uk-form uk-margin-top"
				action="<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=registersave',1,0, $this->config->use_ssl)?>"
				method="post"
				name="loginForm"
				onsubmit="return validateRegistrationForm('<?php print $this->urlcheckdata?>', this.name)"
				autocomplete="off"
				enctype="multipart/form-data"
		>
		
		<?php echo $this->_tmpl_register_html_1?>
		
		<div class="uk-form-row">
			<div>
				<label id="client_type-lbl" for="client_type" class="required"><?php echo _JSHOP_CLIENT_TYPE ?></label>
			</div>
			<div class="uk-form-controls">
				<?php echo $this->select_client_types;?>
			</div>
		</div>
		
		<div class="uk-form-row">
			<div>
				<label id="f_name-lbl" for="f_name" class="required"><?php echo _JSHOP_F_NAME ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="f_name" id="f_name" value="<?php print $this->user->f_name?>" class="required"/>
			</div>
		</div>
		
		<div class="uk-form-row">
			<div>
				<label id="email-lbl" for="email" class="required"><?php echo _JSHOP_EMAIL ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="email" id="email" value="<?php print $this->user->email?>" class="input required"/>
			</div>
		</div>
		
		<div class="uk-form-row">
			<div>
				<label id="email2-lbl" for="email2" class="required"><?php echo _JSHOP_EMAIL2 ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="email2" id="email2" value="<?php print $this->user->email?>" class="input required"/>
			</div>
		</div>
		
		<?php echo $this->_tmpl_register_html_2?>
		
		<?php echo $this->_tmpl_register_html_3?>
		
		<?php echo $this->_tmpl_register_html_4?>
		
		<div class="uk-form-row">
			<div>
				<label id="password-lbl" for="password" class="required"><?php echo _JSHOP_PASSWORD ?> <span id="reg_test_password"></span></label>
			</div>
			<div class = "controls">
				<input type="password" name="password" id="password" value="" class="input registrationTestPassword"/>
			</div>
		</div>
		
		
		
		<div class="uk-form-row">
			<div>
				<label id="password_2-lbl" for="password_2" class="required"><?php echo _JSHOP_PASSWORD_2 ?></label>
			</div>
			<div class = "controls">
				<input type="password" name="password_2" id="password_2" value="" class="input" />
			</div>
		</div>
		
		<?php if ($config_fields['privacy_statement']['display']) : ?>
			<div class = "control-label name">
				<a class="privacy_statement" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=privacy_statement&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;">
				<?php print _JSHOP_PRIVACY_STATEMENT?> <?php if ($config_fields['privacy_statement']['require']) : ?><span>*</span><?php endif; ?>
				</a>
				<div class = "controls">
            <input type="checkbox" name="privacy_statement" id="privacy_statement" value="1" />
          </div>
				
			</div>
		<?php endif; ?>
		
		<?php echo $this->_tmpl_register_html_5?>
		
		<div class="requiredtext uk-margin-top">* <?php print _JSHOP_REQUIRED?></div>
		
		<div class="uk-form-row uk-margin uk-margin-bottom-remove">
			<div class="uk-form-controls uk-text-center">
				<?php echo $this->_tmpl_register_html_6?>
				<input type="submit" class="uk-button" value="Зарегистрироваться" />
			</div>
		</div>
		
		<?php echo JHtml::_('form.token');?>
	</form>
</div>