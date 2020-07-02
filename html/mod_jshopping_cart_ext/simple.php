<?php

defined('_JEXEC') or die();

$url = SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1);

$count = count($cart->products);

//var_dump($cart);
$i = 0;
?>
<div>
	<span class="fl-cart-link">
		<a href="<?php echo $url; ?>">
			<i class="uk-icon-large uk-icon-shopping-cart"></i>
			<?php if($cart->count_product): ?>
			<span class="uk-badge fl-badge-cart-count"><?php echo $cart->count_product; ?></span>
			<?php endif; ?>
		</a>
	</span>
</div>