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
	
	<h1>Изменить адрес доставки</h1>
	
	<form
			class="uk-form"
			action="<?php echo $this->action ?>"
			method="post"
			name="deliveryForm"
			onsubmit="return validateEditAccountForm('<?php echo $this->live_path ?>', this.name)"
			enctype="multipart/form-data"
	>
		<input type="hidden" name="form" value="delivery"/>
	
		<?php if ($config_fields['d_zip']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="d_zip-lbl" for="d_zip" class="required"><?php echo _JSHOP_ZIP ?></label>
			</div>
			<div class="controls">
				<input type="text" name="d_zip" id="d_zip" value="<?php echo $this->user->d_zip ?>" class="required" required />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['d_state']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="d_state-lbl" for="d_state"><?php echo _JSHOP_STATE ?></label>
			</div>
			<div class="controls">
				<input type="text" name="d_state" id="d_state" value="<?php echo $this->user->d_state ?>"/>
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['d_city']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="d_city-lbl" for="d_city" class="required"><?php echo _JSHOP_CITY ?></label>
			</div>
			<div class="controls">
				<input type="text" name="d_city" id="d_city" value="<?php echo $this->user->d_city ?>" class="required" required />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['d_street']['display']){?>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="d_street-lbl" for="d_street" class="required"><?php echo _JSHOP_STREET_NR ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="text" name="d_street" id="d_street" value="<?php echo $this->user->d_street ?>" class="required" required />
			</div>
		</div>
		<?php } ?>
		
		<?php if ($config_fields['privacy_statement']['display']){?>
		<div class="jshop_register">
			<div class="jshop_block_privacy_statement">	
				<div class="control-group">
					<div class="control-label name">
						<a class="privacy_statement" href="#" onclick="window.open('<?php echo SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=privacy_statement&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;">
						<?php echo _JSHOP_PRIVACY_STATEMENT?> <?php if ($config_fields['privacy_statement']['require']){?><span>*</span><?php } ?>
						</a>
					</div>
					<div class="controls">
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