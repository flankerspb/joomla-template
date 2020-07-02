<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

$products_list_id = 'products-new';
$products_list_class = 'uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-medium-1-5 fl-view-grid';
$show_product_label = 0;

//http://amf2.my/index.php?option=com_jshopping&view=products&task=label&label_id=1&category_id=2&Itemid=119&lang=ru

?>
<div class="uk-block">
	<?php if ($this->header):?>
	<h1 class="<?php echo $this->prefix;?>"><?php echo $this->header; ?></h1>
	<?php endif; ?>
<?php
if ($this->display_list_products)
{
	include(__DIR__ .'/../'.$this->template_block_form_filter);
	
	if(count($this->rows))
	{
		include(__DIR__ .'/../'.$this->template_block_list_product);
	}
	else
	{
		// include(__DIR__ .'/../'.$this->template_no_list_product);
	}
	
	if($this->display_pagination)
	{
		// var_dump($this->pagination_obj);
		
		echo '<div class="uk-margin-top">' . $this->pagination . '</div>';
	}
}
?>
</div>