<?php 

defined('_JEXEC') or die('Restricted access');

$counter = $this->pagination_obj->limitstart;

// var_dump($this->rows);




?>
<div class="fl-products" itemscope itemtype="http://schema.org/OfferCatalog">
	<meta itemprop="name" content="<?php echo $this->list_name; ?>">
	<link itemprop="url" href="<?php echo JUri::current(); ?>">
	<?php if (count($this->rows)) : ?>
	<ul id="<?php echo $products_list_id; ?>" class="uk-grid uk-grid-collapse uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-large-1-4 fl-view-grid" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
		<?php foreach ($this->rows as $item) :
			
			//var_dump($item);
			
			if(file_exists($this->image_product_path .'/'. $item->product_thumb_image))
			{
				$alt = $item->name;
			}
			else
			{
				$alt = 'Изображение временно не доступно';
			}
			
			$image_attribs = array();
			$image_attribs['class'] = 'fl-category-product-image';
			$image_attribs['itemprop'] = 'image';
			
			$image = JHtml::image($item->image, $alt, $image_attribs);
			
			$link_attribs = array();
			$link_attribs['class'] = 'uk-position-cover';
			$link_attribs['itemprop'] = 'url';
			
			$link = JHtml::link($item->product_link, '<span class="uk-hidden">' . $item->name . '</span>', $link_attribs);
			
			$label = $item->label_id ? '<div class="fl-panel-label">' . $item->_label_name . '</div>' : '';
			
			// $code = $item->manufacturer_code ? '<div class="fl-code">Артикул: ' . $item->manufacturer_code . '</div>'  : '';
			
			$quantity = '<div class="fl-quantity">'. ((int)$item->product_quantity ? 'На складе: ' . (int)$item->product_quantity : 'Под заказ') .'</div>';
			
			$price = $item->product_price ? '<div class="fl-product-price">'. $item->product_price .'</div>' : '<div class="fl-product-noprice">Цена по запросу' .'</div>';
			
			/* <meta itemprop="position" content="<?php echo ++$counter; ?>"> */
			?>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
			<div class="uk-panel uk-panel-body tm-panel-hover uk-text-center" itemprop="itemOffered" itemscope itemtype="https://schema.org/Product">
				<?php echo $image; ?>
				<?php echo $label; ?>
				<div class="fl-product-desc">
					<h3 class="uk-panel-title tm-title-link" itemprop="name"><?php echo $item->name; ?></h3>
					<?php echo $price, $quantity, $link; ?>
				</div>
			</div>
		</li>
		
		<?php endforeach;?>
	</ul>
	<?php endif; ?>
	
</div>