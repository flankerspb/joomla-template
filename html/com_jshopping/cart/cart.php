<?php
/**
 * @version	  4.16.4 05.10.2017
 * @author	   MAXXmarketing GmbH
 * @package	  Jshopping
 * @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license	  GNU/GPL
 */
defined('_JEXEC') or die();

$countprod = count($this->products);

$cart = true;

?>
<div class="jshop" id="comjshop">
<?php echo $this->checkout_navigator?>
<div class="uk-flex uk-flex-middle uk-flex-space-between uk-margin-bottom">
	<div>
		<div class="uk-flex fl-shop-category-title">
			<h1>Корзина покупок</h1>
		</div>
	</div>
	<?php if ($countprod > 0) : ?>
	<div>
		<a class="uk-button" href="#" onclick="document.updateCart.submit();"><i class="uk-icon-refresh uk-margin-small-right"></i>Пересчитать</a>
		
		<a class="uk-button uk-margin-left" href="<?php echo SEFLink('index.php?option=com_jshopping&controller=cart&task=clear')?>" onclick="return confirm('<?php echo _JSHOP_CONFIRM_REMOVE_ALL?>')"><i class="uk-icon-remove uk-margin-small-right"></i>Очистить</a>
		
	</div>
	<?php endif; ?>
</div>
<?php if ($countprod > 0) : ?>
<hr>
<form action="<?php echo SEFLink('index.php?option=com_jshopping&controller=cart&task=refresh') ?>" method="post" name="updateCart" class="uk-form">

<?php echo $this->_tmp_ext_html_cart_start ?>

	<?php require_once(__DIR__ . '/list_products.php'); ?>

	<?php if ($this->config->summ_null_shipping > 0) : ?>
		<div class = "shippingfree">
			<?php printf(_JSHOP_FROM_PRICE_SHIPPING_FREE, formatprice($this->config->summ_null_shipping, null, 1));?>
		</div>
	<?php endif; ?>

	<div class = "cartdescr"><?php echo $this->cartdescr; ?></div>
	
</form>

<?php else : ?>
	<p><?php echo _JSHOP_CART_EMPTY?></p>
<?php endif; ?>

<div class = "jshop cart_buttons uk-margin-top">
	<?php if($countprod > 0) : ?>
	<div class = "uk-text-right">
		<a href = "<?php echo $this->href_checkout ?>" class="uk-button uk-button-arrow-right">
			<?php echo _JSHOP_CHECKOUT ?>
		</a>
	</div>
	<?php else : ?>
	<div class = "uk-text-left">
		<a href = "<?php echo $this->href_shop ?>" class="uk-button uk-button-arrow-left">
				<?php echo _JSHOP_BACK_TO_SHOP ?>
		</a>
	</div>
	<?php endif; ?>
</div>

</div>