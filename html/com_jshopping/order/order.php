<?php 
/**
* @version	  4.17.0 18.11.2017
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die();
$order = $this->order;

JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');
FlTemplate::addScript('uikit/accordion.js', array('version' => 'auto', 'relative' => true));

switch($order->order_status)
			{
				case '1': //В обработке
					$icon_status = 'uk-icon-clock-o uk-text-muted';
					break;
				case '2': //Принят
					$icon_status = 'uk-icon-share uk-text-muted';
					break;
				case '3': //Отменен
					$icon_status = 'uk-icon-ban uk-text-danger';
					break;
				case '4': //Возвращен
					$icon_status = 'uk-icon-reply uk-text-danger';
					break;
				case '5': //Отправлен
					$icon_status = 'uk-icon-truck uk-text-muted';
					break;
				case '6': //Оплачен
					$icon_status = 'uk-icon-credit-card uk-text-muted';
					break;
				case '7': //Завершен
					$icon_status = 'uk-icon-check uk-text-success';
					break;
				default:
					$icon_status = 'uk-icon-clock-o uk-text-muted';
			}


?>
<div class="jshop myorderinfo">
	
	<h1 class="uk-margin-bottom-remove">Заказ № <?php echo $order->order_number ?></h1>
	<p class="uk-margin-top-remove"><b>Создан: <?php echo formatdate($order->order_date, 0) ?></b></p>
	<div class="uk-accordion uk-margin-top" data-uk-accordion="{showfirst: false}">
		<div class="">
		<span class="uk-text-large">
			<i class="<?php echo $icon_status ?> uk-margin-small-right"></i>
			<?php echo $order->status_name ?>
		</span>
		<span class="uk-accordion-title uk-link">Подробнее</span>
		</div>
		<div class="uk-accordion-content">
			<div class="uk-margin-top">
				<p class="uk-text-large"><?php echo _JSHOP_ORDER_HISTORY ?></p>
				<div class="order_history">
					<table class="uk-table fl-table-auto">
						<?php foreach($order->history as $history){?>
							<tr>
								<td class="date">
									<?php  echo formatdate($history->status_date_added, 0); ?>
								</td>
								<td class="name">
									<?php echo $history->status_name ?>
								</td>
								<td class="comment">
									<?php echo nl2br($history->comments)?>
								</td>
							</tr>
						<?php } ?>
					 </table>
				</div>
			</div>
		</div>
	</div>
	
	<div class = "uk-margin-top">
		<div class = "span6 userbillinfo">
			<table class = "uk-table">
				<tr>
					<td colspan=2><b><?php echo _JSHOP_EMAIL_BILL_TO ?></b></td>
				</tr>
				<?php if ($this->config_fields['firma_name']['display']){?>
				<tr>
					<td><?php echo _JSHOP_FIRMA_NAME?>:</td>
					<td><?php echo $this->order->firma_name?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['f_name']['display']){?>
				<tr>
					<td width = "40%"><?php echo _JSHOP_FULL_NAME?>:</td>
					<td width = "60%"><?php echo $this->order->f_name?> <?php echo $this->order->l_name?> <?php echo $this->order->m_name?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['client_type']['display']){?>
				<tr>
					<td><?php echo _JSHOP_CLIENT_TYPE?>:</td>
					<td><?php echo $this->order->client_type_name;?></td>
				</tr>
				<?php } ?>		
				<?php if ($this->config_fields['firma_code']['display'] && ($this->order->client_type==2 || !$this->config_fields['client_type']['display'])){?>
				<tr>
					<td><?php echo _JSHOP_FIRMA_CODE?>:</td>
					<td><?php echo $this->order->firma_code?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['tax_number']['display'] && ($this->order->client_type==2 || !$this->config_fields['client_type']['display'])){?>
				<tr>
					<td><?php echo _JSHOP_VAT_NUMBER?>:</td>
					<td><?php echo $this->order->tax_number?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['birthday']['display']){?>
				<tr>
					<td><?php echo _JSHOP_BIRTHDAY?>:</td>
					<td><?php echo $this->order->birthday?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['home']['display']){?>
				<tr>
					<td><?php echo _JSHOP_HOME?>:</td>
					<td><?php echo $this->order->home?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['apartment']['display']){?>
				<tr>
					<td><?php echo _JSHOP_APARTMENT?>:</td>
					<td><?php echo $this->order->apartment?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['street']['display']){?>
				<tr>
					<td><?php echo _JSHOP_STREET_NR?>:</td>
					<td><?php echo $this->order->street?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['city']['display']){?>
				<tr>
					<td><?php echo _JSHOP_CITY?>:</td>
					<td><?php echo $this->order->city?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['state']['display']){?>
				<tr>
					<td><?php echo _JSHOP_STATE?>:</td>
					<td><?php echo $this->order->state?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['zip']['display']){?>
				<tr>
					<td><?php echo _JSHOP_ZIP?>:</td>
					<td><?php echo $this->order->zip?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['country']['display']){?>
				<tr>
					<td><?php echo _JSHOP_COUNTRY?>:</td>
					<td><?php echo $this->order->country?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['phone']['display']){?>
				<tr>
					<td><?php echo _JSHOP_TELEFON?>:</td>
					<td><?php echo $this->order->phone?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['mobil_phone']['display']){?>
				<tr>
					<td><?php echo _JSHOP_MOBIL_PHONE?>:</td>
					<td><?php echo $this->order->mobil_phone?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['fax']['display']){?>
				<tr>
					<td><?php echo _JSHOP_FAX?>:</td>
					<td><?php echo $this->order->fax?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['email']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EMAIL?>:</td>
					<td><?php echo $this->order->email?></td>
				</tr>
				<?php } ?>

				<?php if ($this->config_fields['ext_field_1']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_1?>:</td>
					<td><?php echo $this->order->ext_field_1?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['ext_field_2']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_2?>:</td>
					<td><?php echo $this->order->ext_field_2?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['ext_field_3']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_3?>:</td>
					<td><?php echo $this->order->ext_field_3?></td>
				</tr>
				<?php } ?>
				<?php echo $this->tmp_fields?>
			</table>
		</div>
		<div class = "uk-margin-top">
		<?php if ($this->count_filed_delivery >0) {?>
			<table class="uk-table">
				<tr>
					<td colspan="2"><b><?php echo _JSHOP_EMAIL_SHIP_TO ?></b></td>
				</tr>
				<?php if ($this->config_fields['d_firma_name']['display']){?>
				<tr>
					<td><?php echo _JSHOP_FIRMA_NAME?>:</td>
					<td><?php echo $this->order->d_firma_name?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_f_name']['display']){?>
				<tr>
					<td width = "40%"><?php echo _JSHOP_FULL_NAME?> </td>
					<td width = "60%"><?php echo $this->order->d_f_name?> <?php echo $this->order->d_l_name?> <?php echo $this->order->d_m_name?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_birthday']['display']){?>
				<tr>
					<td><?php echo _JSHOP_BIRTHDAY?>:</td>
					<td><?php echo $this->order->d_birthday?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_home']['display']){?>
				<tr>
					<td><?php echo _JSHOP_HOME?>:</td>
					<td><?php echo $this->order->d_home?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_apartment']['display']){?>
				<tr>
					<td><?php echo _JSHOP_APARTMENT?>:</td>
					<td><?php echo $this->order->d_apartment?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_street']['display']){?>
				<tr>
					<td><?php echo _JSHOP_STREET_NR?>:</td>
					<td><?php echo $this->order->d_street?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_city']['display']){?>
				<tr>
					<td><?php echo _JSHOP_CITY?>:</td>
					<td><?php echo $this->order->d_city?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_state']['display']){?>
				<tr>
					<td><?php echo _JSHOP_STATE?>:</td>
					<td><?php echo $this->order->d_state?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_zip']['display']){?>
				<tr>
					<td><?php echo _JSHOP_ZIP ?>:</td>
					<td><?php echo $this->order->d_zip ?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_country']['display']){?>
				<tr>
					<td><?php echo _JSHOP_COUNTRY ?>:</td>
					<td><?php echo $this->order->d_country ?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_phone']['display']){?>
				<tr>
					<td><?php echo _JSHOP_TELEFON ?>:</td>
					<td><?php echo $this->order->d_phone ?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_mobil_phone']['display']){?>
				<tr>
					<td><?php echo _JSHOP_MOBIL_PHONE?>:</td>
					<td><?php echo $this->order->d_mobil_phone?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_fax']['display']){?>
				<tr>
					<td><?php echo _JSHOP_FAX ?>:</td>
					<td><?php echo $this->order->d_fax ?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_email']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EMAIL ?>:</td>
					<td><?php echo $this->order->d_email ?></td>
				</tr>
				<?php } ?>							
				<?php if ($this->config_fields['d_ext_field_1']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_1?>:</td>
					<td><?php echo $this->order->d_ext_field_1?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_ext_field_2']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_2?>:</td>
					<td><?php echo $this->order->d_ext_field_2?></td>
				</tr>
				<?php } ?>
				<?php if ($this->config_fields['d_ext_field_3']['display']){?>
				<tr>
					<td><?php echo _JSHOP_EXT_FIELD_3?>:</td>
					<td><?php echo $this->order->d_ext_field_3?></td>
				</tr>
				<?php } ?>
				<?php echo $this->tmp_d_fields?>
			</table>
		<?php } ?>
		</div>
		<?php echo $this->_tmp_html_after_customer_info; ?>
	</div>
	
	
	<?php if ($this->config->order_send_pdf_client) : ?>
		<div class="downlod_order_invoice">
			<a class="btn" target="_blank" href="<?php echo $this->config->pdf_orders_live_path."/".$order->pdf_file;?>">
				<?php echo _JSHOP_DOWNLOAD_INVOICE?>
			</a>
		</div>
	<?php endif; ?>
	
		<div class = "order_items">
		<table class="uk-table">
			<tr class="total">
				<td colspan="4"><b><?php echo _JSHOP_PRODUCTS; ?></b></td>
			</tr>
		<?php
		$i=1;
		$countprod = count($order->items);
		foreach($order->items as $key_id=>$prod)
		{
			$files = unserialize($prod->files);
		?>
			<tr>
				<td class="product_name">
					<p class="data">
						<?php if($prod->manufacturer_code) echo '(' . $prod->manufacturer_code . ') '; ?>
						<?php echo $prod->product_name?>
					</p>
					<p>
						<?php 
							echo sprintAtributeInOrder($prod->product_attributes);
							echo sprintFreeAtributeInOrder($prod->product_freeattributes);
							echo $prod->_ext_attribute_html;
						?>
					</p>
				</td>
				<td class="fl-min-td">
					<?php
						echo formatprice($prod->product_item_price, $order->currency_code); 
						
						if($this->config->show_tax_product_in_cart && $prod->product_tax > 0)
						{
							echo '<span class="taxinfo">' . productTaxInfo($prod->product_tax, $order->display_price) . '</span>';
						}
						
						if($this->config->cart_basic_price_show && $prod->basicprice > 0)
						{
							echo _JSHOP_BASIC_PRICE . '<span>' . sprintBasicPrice($prod) . '</span>';
						}
					?>
				</td>
				<td class="fl-min-td">
					<?php echo formatqty($prod->product_quantity);?><?php echo $prod->_qty_unit;?>
				</td>
				<td class="fl-min-td uk-text-right">
					<div class="data">
						<?php echo formatprice($prod->product_item_price * $prod->product_quantity, $order->currency_code); ?>
						<?php echo $prod->_ext_price_total_html?>
						<?php if ($this->config->show_tax_product_in_cart && $prod->product_tax>0){?>
							<span class="taxinfo"><?php echo productTaxInfo($prod->product_tax, $order->display_price);?></span>
						<?php }?>
					</div>
				</td>
				<?php echo $prod->_tmpl_html_order_items_end?>
			</tr>
		<?php $i++; } ?>
		<?php if (!$this->hide_subtotal){?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo _JSHOP_SUBTOTAL ?></td>
				<td class="uk-text-right"><?php echo formatprice($order->order_subtotal, $order->currency_code) ?></td>
			</tr>
		<?php } ?>
		<?php if ($order->order_discount > 0){ ?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo _JSHOP_RABATT_VALUE ?><?php echo $this->_tmp_ext_discount_text?></td>
				<td class="uk-text-right"><?php echo formatprice(-$order->order_discount, $order->currency_code) ?></td>
			</tr>
		<?php } ?>
		<?php if (!$this->config->without_shipping || $order->order_shipping > 0){ ?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo _JSHOP_SHIPPING_PRICE;?></td>
				<td class="uk-text-right"><?php echo formatprice($order->order_shipping, $order->currency_code); ?><?php echo $this->_tmp_ext_shipping?></td>
			</tr>
		<?php } ?>
		<?php if (!$this->config->without_shipping && ($order->order_package>0 || $this->config->display_null_package_price)){ ?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo _JSHOP_PACKAGE_PRICE;?></td>
				<td class="uk-text-right"><?php echo formatprice($order->order_package, $order->currency_code); ?>
					<?php echo $this->_tmp_ext_shipping_package?></td>
			</tr>
		<?php } ?>
		<?php  if ($this->order->order_payment > 0){ ?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo $this->order->payment_name;?></td>
				<td class="uk-text-right"><?php echo formatprice($this->order->order_payment, $order->currency_code);?>
					<?php echo $this->_tmp_ext_payment?></td>
			</tr>
		<?php } ?>
			<tr>
				<td class="uk-text-right" colspan="3"><?php echo $this->text_total; ?></td>
				<td class="uk-text-right"><?php echo formatprice($order->order_total, $order->currency_code);?>
				<?php echo $this->_tmp_ext_total?></td>
			</tr>
		</table>
	</div>

	<?php if (!$this->config->without_shipping){?>
		<div class="shipping_block_info">
			<div class="shipping_info">
				<b><?php echo _JSHOP_SHIPPING_INFORMATION ?>: </b><?php echo nl2br($order->shipping_info);?>
				<?php if($order->shipping_params) :?>
				<span class="uk-text-muted">(<?php echo nl2br($order->shipping_params);?>)</span>
				<?php endif; ?>
				<?php if ($order->delivery_time_name){?>
					<div class="delivery_time">
						<?php echo _JSHOP_DELIVERY_TIME.": ".$order->delivery_time_name?>
					</div>
				<?php }?>
				<?php if ($order->delivery_date_f){?>
					<div class="delivery_date">
						<?php echo _JSHOP_DELIVERY_DATE.": ".$order->delivery_date_f?>
					</div>
				<?php }?>
				<?php echo $this->_tmp_html_shipping_block_info_end;?>
			</div>
		</div>
	<?php }?>
	
	<?php if (!$this->config->without_payment){?>
		<div class="payment_block_info">
			<div class="payment_head">
				<b><?php echo _JSHOP_PAYMENT_INFORMATION ?></b>
			</div>
			<div class="payment_info">
				<?php echo $order->payment_name;?>
			</div>
			<div class="order_payment_params">
				<?php echo nl2br($order->payment_params);?>
				<?php echo $order->payment_description;?>
			</div>
		</div>
	<?php }?>

	<?php if ($order->order_add_info){ ?>
		<div class="order_comment">
			<div class="order_comment_head">
				<b><?php echo _JSHOP_ORDER_COMMENT ?></b>
			</div>
			<div class="order_comment_info">
				<?php echo $order->order_add_info ?>
			</div>
		</div>
	<?php } ?>
	
	<?php echo $this->_tmp_html_after_comment;?>

	
	
	<?php echo $this->_tmp_html_after_history;?>
	
	<?php if ($this->allow_cancel){?>
		<div class="button_cance uk-margin-top">
			<a href="<?php echo SEFLink('index.php?option=com_jshopping&controller=user&task=cancelorder&order_id='.$order->order_id)?>" class = "btn">
				<?php echo _JSHOP_CANCEL_ORDER?>
			</a>
		</div>
	<?php }?>
	
	<?php echo $this->_tmp_html_end;?>
</div>