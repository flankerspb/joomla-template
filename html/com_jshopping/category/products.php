<?php 

defined('_JEXEC') or die('Restricted access');

if($this->display_list_products)
{
	// include(__DIR__ .'/../'.$this->template_block_form_filter);
	
	if(count($this->rows))
	{
		include(__DIR__ .'/../'.$this->template_block_list_product);
	}
	else
	{
		include(__DIR__ .'/../'.$this->template_no_list_product);
	}
	
	if($this->display_pagination)
	{
		echo '<div class="uk-margin-top">' . $this->pagination . '</div>';
	}
}
