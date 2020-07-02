<?php

defined('_JEXEC') or die();

$url = SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1);

$count = count($cart->products);

//var_dump($cart);
$i = 0;
?>
<?php if($cart->count_product): ?>
<div id="cart-mmodule">
	<span class="fl-cart-link" data-uk-dropdown="{pos:'bottom-right'}">
		<a href="<?php echo $url; ?>">
			<i class="uk-icon-large uk-icon-shopping-cart"></i>
			<?php if($cart->count_product): ?>
			<span class="uk-badge fl-badge-cart-count"><?php echo $cart->count_product; ?></span>
			<?php endif; ?>
		</a>
		<div class="uk-dropdown fl-dropdown-cart">
			<table class="uk-table uk-table-condensed fl-table-cart-products" width="100%">
			<?php foreach($cart->products as $product) : ?>
				<tr>
					<td class="fl-cart-product-name"><?php echo $product['product_name']; ?></td>
					<td class="fl-cart-product-quantity">
						<span class="uk-badge"><?php echo $product['quantity']; ?>x</span>
					</td>
					<td class="fl-cart-product-price"><?php echo formatprice($product['price']); ?></td>
				</tr>
			<?php endforeach; ?>
			</table>
				<?php if($cart->count_product > 1): ?>
				<div class="fl-cart-product-price uk-text-bold">Итого: <?php echo formatprice($cart->summ); ?></div>
				<?php endif; ?>
			<div class="uk-text-center uk-margin-small-top">
				<a class="uk-button uk-button-small "href="<?php echo $url; ?>">Перейти в корзину</a>
			</div>
		</div>
	</span>
</div>
<?php else : ?>
<div id="jshop_module_cart" data-uk-dropdown>
	<span><i class="uk-icon-large uk-icon-shopping-cart"></i></span>
</div>
<?php endif; ?>