<?php
/**
* @version	  4.16.2 24.05.2017
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die();
?>
<div class="jshop">
<table class="uk-table">
	<?php
	$i=1;
	foreach($this->products as $key_id=>$prod) :
		echo $prod['_tmp_tr_before'];
	?>
	<tr class = "jshop_prod_cart <?php if ($i%2==0) print "even"; else print "odd"?>">
		<td class="uk-hidden-small">
			<?php
				$image = $prod['thumb_image'] ? $prod['thumb_image'] : $this->no_image;
				
				echo JHtml::image($this->image_product_path.'/'.$image, htmlspecialchars($prod['product_name']), ['width' => 80, 'height' => 80]);
			?>
		</td>
		<td class="product_name">
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
		<td class="quantity">
			<?php echo $prod['quantity'] . ' ' .  $prod['_qty_unit'];?>
		</td>
		<td class="fl-min-td">
			<?php echo formatprice($prod['price'] * $prod['quantity']);
						echo $prod['_ext_price_total_html'] ;
						if($this->config->show_tax_product_in_cart && $prod['tax'] > 0)
						{
							echo '<span class="taxinfo">' . productTaxInfo($prod['tax']) . '</span>';
						}
			?>
		</td>
	</tr>
	<?php $i++; endforeach; ?>
	
	<?php if ($this->config->show_weight_order) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_WEIGHT_PRODUCTS?>:</td>
		<td><?php echo formatweight($this->weight);?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if (!$this->hide_subtotal && $this->summ != $this->fullsumm) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_SUBTOTAL?>:</td>
		<td><?php echo formatprice($this->summ), $this->_tmp_ext_subtotal;?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->discount > 0) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_RABATT_VALUE, $this->_tmp_ext_discount_text?></td>
		<td><?php echo formatprice(-$this->discount), $this->_tmp_ext_discounts;?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if (isset($this->summ_delivery) && $this->summ_delivery > 0) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_SHIPPING_PRICE?></td>
		<td><?php echo  formatprice($this->summ_delivery), $this->_tmp_ext_shipping;?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if (isset($this->summ_package)) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_PACKAGE_PRICE?></td>
		<td><?php echo formatprice($this->summ_package), $this->_tmp_ext_shipping_package;?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if ($this->summ_payment != 0) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo $this->payment_name?></td>
		<td><?php echo formatprice($this->summ_payment), $this->_tmp_ext_payment;?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	<?php if (!$this->config->hide_tax) : ?>
	<?php foreach($this->tax_list as $percent=>$value) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo displayTotalCartTaxName(); if ($this->show_percent_tax) echo formattax($percent).'%'?></td>
		<td><?php echo formatprice($value), $this->_tmp_ext_tax[$percent];?></td>
		<td></td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
	
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo $this->text_total; ?></td>
		<td><?php echo formatprice($this->fullsumm), $this->_tmp_ext_total; ?></td>
		<td></td>
	</tr>
	
	<?php if ($this->free_discount > 0) : ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo _JSHOP_FREE_DISCOUNT; ?></td>
		<td><?php echo formatprice($this->free_discount); ?></td>
		<td></td>
	</tr>
	<?php endif; ?>
	
	
</table>

<?php print $this->_tmp_html_after_subtotal?>
<?php print $this->_tmp_html_after_total?>

<div class="cartdescr"><?php print $this->checkoutcartdescr;?></div>

<?php print $this->_tmp_html_after_checkout_cart?>

</div>