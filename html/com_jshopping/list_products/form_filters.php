<?php 
/**
* @version	  4.8.0 13.08.2013
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');

?>
<div class="fl-products-filter uk-margin-bottom">
	<div class="fl-table">
		<div>
			<?php if (isset($this->pagination_obj) && $this->config->product_list_pagination_result_counter) :?>
			<div class="uk-text-center uk-hidden-small">
				<?php echo $this->pagination_obj->getResultsCounter(); ?>
			</div>
			<?php endif; ?>
			
			<form action="<?php echo $this->action;?>" method="post" name="sort_count" id="sort_count" class="uk-form">
				<input type="hidden" name="orderby" id="orderby" value="<?php echo $this->orderby?>" />
				<input type="hidden" name="limitstart" value="0" />
				<?php echo $this->sorting; ?>
				
				<?php if ($this->config->show_count_select_products) : ?>
					<?php echo $this->product_count; ?>
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>