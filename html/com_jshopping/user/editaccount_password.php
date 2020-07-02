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
	
	<h1>Изменить пароль</h1>
	
	<form
			class="uk-form"
			action="<?php echo $this->action ?>"
			method="post"
			name="passwordForm"
			onsubmit="return validateEditAccountForm('<?php echo $this->live_path ?>', this.name)"
			enctype="multipart/form-data"
	>
		<input type="hidden" name="form" value="password"/>
		
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="password-lbl" for="password" class="required">Новый пароль</label>
			</div>
			<div class="uk-form-controls">
				<input type="password" name="password" id="password" class="required" required/>
			</div>
		</div>
		<div class="uk-form-row">
			<div class="control-label name">
				<label id="password_2-lbl" for="password_2" class="required"><?php echo _JSHOP_PASSWORD_2 ?></label>
			</div>
			<div class="uk-form-controls">
				<input type="password" name="password_2" id="password_2" class="required" required/>
			</div>
		</div>
		<div class="uk-form-row uk-text-center">
			<input type="submit" name="next" value="<?php echo _JSHOP_SAVE ?>" class="uk-button" />
		</div>
	</form>
</div>