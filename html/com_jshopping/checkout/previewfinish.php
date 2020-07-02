<?php 
/**
* @version	  4.18.3 15.02.2019
* @author		MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div id="comjshop">
	<h1>Оформление заказа</h1>
	<div><?php print $this->checkout_navigator; ?></div>
	<?php print $this->small_cart?>
	
	<div class="jshop checkout_pfinish_block">
		<?php print $this->_tmp_ext_html_previewfinish_start?>
		
		<div class="checkoutinfo">
			<div class="bill_address">
				<strong>Покупатель</strong>:
				<span>
				<?php if ($this->invoice_info['firma_name']) print $this->invoice_info['firma_name'].", ";?> 
				<?php print $this->invoice_info['f_name'] ?> 
				<?php print $this->invoice_info['l_name'] ?>, 
				<?php if ($this->invoice_info['street'] && $this->invoice_info['street_nr']) print $this->invoice_info['street']." ".$this->invoice_info['street_nr'].","?>
				<?php if ($this->invoice_info['street'] && !$this->invoice_info['street_nr']) print $this->invoice_info['street'].","?>
				<?php if ($this->invoice_info['home'] && $this->invoice_info['apartment']) print $this->invoice_info['home']."/".$this->invoice_info['apartment'].","?>
				<?php if ($this->invoice_info['home'] && !$this->invoice_info['apartment']) print $this->invoice_info['home'].","?>
				<?php if ($this->invoice_info['state']) print $this->invoice_info['state']."," ?> 
				<?php print $this->invoice_info['zip']." ".$this->invoice_info['city']." ".$this->invoice_info['country']?>
				<?php if ($this->invoice_info['email'] && $this->config->checkout_step5_show_email) print $this->invoice_info['email']?>
				<?php if ($this->invoice_info['phone'] && $this->config->checkout_step5_show_phone) print $this->invoice_info['phone']?>
				</span>
			</div>
			
			<?php if ($this->count_filed_delivery)
				{
					
					$adress = [
							'zip',
							'country',
							'state',
							'city',
							'street',
							'street_nr',
							'home',
							'apartment',
					];
					
					$delivery_adress = [];
					
					foreach($adress as $v)
					{
						if($this->delivery_info[$v])
						{
							$delivery_adress[$v] = $this->delivery_info[$v];
						}
					}
				
					if(count($delivery_adress))
					{
					?>
					<div class="delivery_address">
						<strong><?php echo _JSHOP_FINISH_DELIVERY_ADRESS?></strong>: 
						<span>
							<?php echo implode(', ', $delivery_adress); ?>
						</span>
					</div>
					<?php
					}
				}
				?>
			
			<?php if (!$this->config->without_payment){?>
				<div class="payment_info">
					<strong><?php print _JSHOP_FINISH_PAYMENT_METHOD ?></strong>: <span><?php print $this->payment_name ?></span>
				</div>
			<?php } ?>
		</div>

		<form 
			name="form_finish"
			action="<?php print $this->action ?>"
			method="post" enctype="multipart/form-data"
		>
			<div class="pfinish_comment_block">
				<div class="name uk-margin-top"><?php print _JSHOP_ADD_INFO ?></div>
				<div class="field">
					<textarea class = "inputbox" id = "order_add_info" name = "order_add_info"style="width:100%;max-width:100%;"></textarea>
				</div>

				<?php if ($this->config->display_agb){?>
					<div class="row_agb uk-margin-top">
						<input type = "checkbox" name="agb" id="agb" />
						<a class = "policy" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=agb&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_AGB;?></a>
						<?php print _JSHOP_AND;?>
						<a class = "policy" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component&cart=1', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_RETURN_POLICY?></a>
						<?php print _JSHOP_CONFIRM;?>
					</div>
				<?php }?>
				
				<?php if($this->no_return){?>
					<div class="row_no_return uk-margin-top">
						<input type = "checkbox" name="no_return" id="no_return" />
						<?php print _JSHOP_NO_RETURN_DESCRIPTION;?>
					</div>
				<?php }?>
				
				<?php print $this->_tmp_ext_html_previewfinish_agb?>
				<div class="uk-text-right uk-margin-top"> 
					<?php print $this->_tmp_ext_html_previewfinish_before_button?>
					<input class="uk-button" type="submit" name="finish_registration" value="<?php print _JSHOP_ORDER_FINISH?>" onclick="return checkAGBAndNoReturn('<?php echo $this->config->display_agb;?>','<?php echo $this->no_return?>');" />
				</div>
			</div> 
			<?php print $this->_tmp_ext_html_previewfinish_end?>
		</form>
		
	</div>
</div>