<?php 
/**
* @version	  4.11.1 13.08.2013
* @author	   MAXXmarketing GmbH
* @package	  Jshopping
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license	  GNU/GPL
*/
defined('_JEXEC') or die();
?>
<div class="jshop myorders_list" id="comjshop">
	
	<h1><?php echo _JSHOP_MY_ORDERS ?></h1>
	
	<?php echo $this->_tmp_html_before_user_order_list;?>
	
	<?php if(count($this->orders)) : ?>
	<table class="uk-table">
		<tbody>
		<?php foreach ($this->orders as $order) : 
			
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
			<tr>
				<td class="fl-min-td uk-text-center"><i class="<?php echo $icon_status ?>"></i></td>
				<td><a href="<?php echo $order->order_href ?>">№ <?php echo $order->order_number?></a><br><?php echo $order->status_name?></td>
				<td class="uk-text-center">от <?php echo formatdate($order->order_date, 0) ?></td>
				<td class="uk-text-right"><?php echo formatprice($order->order_total, $order->currency_code)?></td>
			</tr>
		<?php endforeach; ?>
			<tr>
				<td class="uk-text-right" colspan="4"><?php echo _JSHOP_TOTAL .': '. formatprice($this->total, getMainCurrencyCode())?></td>
			</tr>
		</tbody>
	</table>
	<?php else : ?>
		<div class="myorders_no_orders">
			<?php echo _JSHOP_NO_ORDERS ?>
		</div>
	<?php endif; ?>

</div>