<?php
/**
 * @version	  4.16.4 05.10.2017
 * @author	   MAXXmarketing GmbH
 * @package	  Jshopping
 * @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license	  GNU/GPL
 */
defined('_JEXEC') or die();

$countprod=count($this->products);

$wishlist=true;


?>
<div class="jshop" id="comjshop">

<h1>Лист желаний</h1>

<?php if ($countprod > 0) : ?>

<?php require_once(__DIR__ . '/list_products.php'); ?>

<?php else : ?>
	<div class="wishlist_empty_text"><?php print _JSHOP_WISHLIST_EMPTY ?></div>
<?php endif; ?>

<?php print $this->_tmp_html_before_buttons?>


<div id="checkout" class="uk-margin-top uk-flex uk-flex-space-between">
	<div>
		<a href="<?php print $this->href_shop ?>" class="uk-button">
			<i class="uk-icon-arrow-left uk-margin-small-right"></i><?php print _JSHOP_BACK_TO_SHOP ?>
		</a>
	</div>
	<?php if ($countprod > 0) : ?>
	<div>
		<a href="<?php print $this->href_checkout ?>" class="uk-button">
			<?php print _JSHOP_GO_TO_CART ?><i class="uk-icon-arrow-right uk-margin-small-left"></i>
		</a>
	</div>
	<?php endif; ?>
</div>

<?php print $this->_tmp_html_after_buttons?>

</div>