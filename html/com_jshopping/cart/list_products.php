<?php
/**
 * @version	  4.16.4 05.10.2017
 * @author	   MAXXmarketing GmbH
 * @package	  Jshopping
 * @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license	  GNU/GPL
 */

defined('_JEXEC') or die();

?>
<table class="uk-table uk-table-middle">
	<?php foreach ($this->products as $key_id => $prod) : ?>
	<tr class="jshop_prod_cart">
		<td class="product_name">
			<div class="fl-inline-block uk-hidden-small">
			<?php
				$image = $prod['thumb_image'] ? $prod['thumb_image'] : $this->no_image;
				
				echo JHtml::image($this->image_product_path.'/'.$image, htmlspecialchars($prod['product_name']), ['width' => 80, 'height' => 80]);
			?>
			</div>
			<div  class="fl-inline-block">
				<p class="data">
					<?php if($prod['manufacturer_code']) echo '(' . $prod['manufacturer_code'] . ') '; ?>
					<a href="<?php echo $prod['href'] ?>">
						<?php echo $prod['product_name'] ?>
					</a>
					<?php echo $prod['_ext_product_name'] ?>
				</p>
				<p>
					<?php 
						echo sprintAtributeInCart($prod['attributes_value']);
						echo sprintFreeAtributeInCart($prod['free_attributes_value']);
						echo sprintFreeExtraFiledsInCart($prod['extra_fields']);
						echo $prod['_ext_attribute_html'];
					?>
				</p>
				<?php if($this->config->show_delivery_time_step5 && $prod['delivery_times_id']) : ?>
				<p>
					<?php echo _JSHOP_DELIVERY_TIME . $this->deliverytimes[$prod['delivery_times_id']]?>
				</p>
				<?php endif; ?>
			</div>
		</td>
		<td class="fl-min-td">
			<?php
				echo formatprice($prod['price']) , $prod['_ext_price_html']; 
				
				if($this->config->show_tax_product_in_cart && $prod['tax'] > 0)
				{
					echo '<span class="taxinfo">' . productTaxInfo($prod['tax']) . '</span>';
				}
				
				if($this->config->cart_basic_price_show && $prod['basicprice'] > 0)
				{
					echo _JSHOP_BASIC_PRICE . '<span>' . sprintBasicPrice($prod) . '</span>';
				}
			?>
		</td>
		<td class="fl-min-td">
		<?php if ($cart): ?>
			<input type="number" class="fl-quantity-input" id="quantity_<?php echo $key_id; ?>" name="quantity[<?php echo $key_id ?>]" min="1" value = "<?php echo $prod['quantity'] ?>" size="1">
		<?php else: ?>
			<?php echo $prod['quantity']?>
		<?php endif; ?>
		<?php echo $prod['_qty_unit'];?>
		</td>
		<td class="fl-min-td uk-text-right">
			<?php echo formatprice($prod['price'] * $prod['quantity']);
						echo $prod['_ext_price_total_html'] ;
						if($this->config->show_tax_product_in_cart && $prod['tax'] > 0)
						{
							echo '<span class="taxinfo">' . productTaxInfo($prod['tax']) . '</span>';
						}
			?>
		</td>
		<td class="fl-min-td uk-text-right">
			<?php if($wishlist) : ?>
				<a class="uk-button uk-button-shopping-cart" href = "<?php print $prod['remove_to_cart'] ?>" ><i class="uk-icon-cart-plus"></i></a>
			<?php endif; ?>
			<a class="uk-button" href="<?php echo $prod['href_delete']?>"><i class="uk-icon-remove"></i></a>
		</td>
	</tr>
	<?php endforeach; ?>
	
	<?php if($cart || $checkout) : ?>
	<?php if (!$this->hide_subtotal) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_SUBTOTAL ?></td>
		<td><?php echo formatprice($this->summ);?><?php echo $this->_tmp_ext_subtotal?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	<?php if ($this->discount > 0) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_RABATT_VALUE, $this->_tmp_ext_discount_text; ?></td>
		<td><?php echo formatprice(-$this->discount);?><?php echo $this->_tmp_ext_discount; ?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	<?php if (!$this->config->hide_tax) :
				foreach($this->tax_list as $percent=>$value): ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo displayTotalCartTaxName(); if($this->show_percent_tax) echo formattax($percent)."%"; ?></td>
		<td><?php echo formatprice($value);?><?php echo $this->_tmp_ext_tax[$percent]?></td>
		<td></td>
	</tr>
	<?php endforeach;
				endif; ?>
	
	<tr class="total">
		<td></td>
		<td colspan="3" class="uk-text-right"><b><?php echo _JSHOP_PRICE_TOTAL ?></b></td>
		<td class="fl-min-td uk-text-right"><b><?php echo formatprice($this->fullsumm)?><?php echo $this->_tmp_ext_total; ?></b></td>
		<td></td>
	</tr>
	<?php endif; ?>
</table>