<?php 
/**
* @version      4.8.0 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div id="comjshop">
	<h1>Заказ оформлен</h1>
	
	<?php 
	if (!empty($this->text))
	{
		echo $this->text;
	}
	else
	{
		echo '<p class="uk-text-large">' . _JSHOP_THANK_YOU_ORDER . '</p>';
	}
	?>
</div>