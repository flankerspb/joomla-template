<?php 
/**
* @version      4.10.0 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class="jshop pagelogin" id="comjshop">
	<h1 class="uk-text-center"><?php echo _JSHOP_LOGIN ?></h1>
	
	<div>
		<?php echo $this->checkout_navigator?>
		<?php if($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
			<span class= "text_pay_without_reg"><?php echo _JSHOP_ORDER_WITHOUT_REGISTER_CLICK?> <a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=checkout&task=step2',1,0, $this->config->use_ssl);?>"><?php echo _JSHOP_HERE?></a></span>
		<?php endif; ?>
		
		<?php echo $this->tmpl_login_html_1?>
		
		<form method="post" action="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=loginsave', 1,0, $this->config->use_ssl)?>" name="jlogin" class="uk-form uk-margin-top">
		
			<div class="uk-form-row">
				<div>
					<label id="username-lbl" for="jlusername"><?php echo _JSHOP_USERNAME ?>:</label>
				</div>
				<div class="uk-form-controls">
					<input type="text" id="jlusername" name="username" value="" class="inputbox" />
				</div>
			</div>
			
			<div class="uk-form-row">
				<div>
					<label id="password-lbl" class="" for="jlpassword"><?php echo _JSHOP_PASSWORT ?>:</label>
				</div>
				<div class="uk-form-controls">
					<input type="password" id="jlpassword" name="passwd" value="" class="inputbox" />
				</div>
			</div>
			
			<div class="uk-form-row uk-margin">
				<label class="uk-margin-small-top"><input type="checkbox" name="remember" id="remember_me" value="yes" /> <?php echo _JSHOP_REMEMBER_ME ?></label>
			</div>
			
			<div class="uk-form-row uk-margin uk-margin-bottom-remove">
				<div class="uk-form-controls uk-text-center">
					<input type="submit" class="uk-button" value="Войти" />
				</div>
			</div>
			
			<input type = "hidden" name = "return" value = "<?php echo $this->return ?>" />
			<?php echo JHtml::_('form.token');?>
			<?php echo $this->tmpl_login_html_3?>
		</form>
		
		<a href = "<?php echo $this->href_lost_pass ?>"><?php echo _JSHOP_LOST_PASSWORD ?></a>
		<br>
		<?php if($this->allowUserRegistration): ?>
		<a href="<?php echo $this->href_register ?>">Регистриция</a>
		<?php endif; ?>
		
		<?php echo $this->tmpl_login_html_4?>
		<?php echo $this->tmpl_login_html_5?>
		<?php echo $this->tmpl_login_html_6?>
	</div>
</div>