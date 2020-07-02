<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');



$this->list_name = htmlspecialchars(_JSHOP_SEARCH_RESULT . ': "' .$this->search.'"');

?>
<div>
	<div class="uk-flex uk-flex-middle uk-flex-space-between uk-margin-bottom">
		<div>
			<div class="uk-flex fl-shop-category-title">
				<h1><?php echo $this->list_name;?></h1>
				<div class="uk-h1 uk-text-muted uk-margin-small-left">(<?php echo $this->total; ?>)</div>
			</div>
		</div>
		<form action="<?php echo $this->action;?>" method="post" name="sort_count" id="sort_count" class="uk-form">
			<input type="hidden" name="orderby" id="orderby" value="<?php echo $this->orderby?>" />
			<input type="hidden" name="limitstart" value="0" />
			<?php echo $this->sorting; ?>
			
			<?php if ($this->config->show_count_select_products) : ?>
				<?php echo $this->product_count; ?>
			<?php endif; ?>
		</form>
	</div>
	<?php if (count($this->rows)) : ?>
	<div class="jshop_list_product">
		<?php
		
		if(count($this->rows))
		{
			include(dirname(__FILE__)."/../".$this->template_block_list_product);
		}
		
		if ($this->display_pagination)
		{
			include(dirname(__FILE__)."/../".$this->template_block_pagination);
		}
		?>
	</div>
	<?php endif; ?>
</div>