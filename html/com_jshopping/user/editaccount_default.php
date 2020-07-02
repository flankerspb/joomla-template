<?php 
/**
* @version	  4.8.0 18.08.2013
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');


?>
<div class="jshop editaccount_block" id="comjshop">
	
	<h1>Изменить личные данные</h1>
	
	<form
			class="uk-form"
			action="<?php echo $this->action ?>"
			method="post"
			name="loginForm"
			onsubmit="return validateEditAccountForm('<?php echo $this->live_path ?>', this.name)"
			enctype="multipart/form-data"
	>
			
		<?php if ($config_fields['f_name']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="f_name-lbl" for="f_name" class="required"><?php echo _JSHOP_F_NAME ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="f_name" id="f_name" value="<?php echo $this->user->f_name ?>"  class="required" required />
			</div>
		</div>
		<?php } ?>
			
		<?php if ($config_fields['m_name']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="m_name-lbl" for="m_name" ><?php echo _JSHOP_M_NAME ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="m_name" id="m_name" value="<?php echo $this->user->m_name ?>" />
			</div>
		</div>
		<?php } ?>
			
		<?php if ($config_fields['l_name']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="l_name-lbl" for="l_name"><?php echo _JSHOP_L_NAME ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="l_name" id="l_name" value="<?php echo $this->user->l_name ?>" />
			</div>
		</div>
		<?php } ?>
			
		<?php if($this->user->client_type == 1){?>
		<?php if($config_fields['birthday']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<?php echo _JSHOP_BIRTHDAY ?> <?php if ($config_fields['birthday']['require']){?><span>*</span><?php } ?>
			</div>
			<div class="uk-form-controls">
				<?php echo JHTML::_('calendar', $this->user->birthday, 'birthday', 'birthday', $this->config->field_birthday_format, array('class'=>'input', 'size'=>'25', 'maxlength'=>'19'));?>
			</div>
		</div>
		<?php } ?>
		<?php } ?>
		
		<?php if($this->user->client_type == 2){?>
		
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="firma_name-lbl" for="firma_name" class="required">Организация</label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="firma_name" id="firma_name" value="<?php echo $this->user->firma_name ?>" class="required" required />
			</div>
		</div>
		
		<?php } ?>
			
		<?php if ($config_fields['phone']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="phone-lbl" for="phone" class="required"><?php echo _JSHOP_TELEFON ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="phone" id="phone" value="<?php echo $this->user->phone ?>" class="input" />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['mobil_phone']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="mobil_phone-lbl" for="mobil_phone"><?php echo _JSHOP_MOBIL_PHONE ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="mobil_phone" id="mobil_phone" value="<?php echo $this->user->mobil_phone ?>" class="input" />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['fax']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="fax-lbl" for="fax"><?php echo _JSHOP_FAX ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="fax" id="fax" value="<?php echo $this->user->fax ?>" class="input" />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['privacy_statement']['display']){?>
		<div class="jshop_register">
			<div class="jshop_block_privacy_statement">	
				<div class="uk-form-row">
					<div class="control-label name">
						<a class="privacy_statement" href="#" onclick="window.open('<?php echo SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=privacy_statement&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;">
						<?php echo _JSHOP_PRIVACY_STATEMENT?> <?php if ($config_fields['privacy_statement']['require']){?><span>*</span><?php } ?>
						</a>			
					</div>
					<div class="uk-form-controls">
						<input type="checkbox" name="privacy_statement" id="privacy_statement" value="1" />
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<div class="uk-form-row uk-text-center">
			<input type="submit" name="next" value="<?php echo _JSHOP_SAVE ?>" class="uk-button" />
		</div>
	</form>
</div>