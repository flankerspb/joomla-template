<?php

defined('_JEXEC') or die();

JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

FlTemplate::addScript('uikit/lightbox.js', array('version' => 'auto', 'relative' => true));
FlTemplate::addScript('uikit/slideshow.js', array('version' => 'auto', 'relative' => true));
FlTemplate::addScript('uikit/slider.js', array('version' => 'auto', 'relative' => true));


$item = $this->product;

// echo '<pre>';
// debug_print_backtrace();
// echo '</pre>';


$lang = JFactory::getLanguage()->getTag();
$category = JTable::getInstance('category', 'jshop');
$category->load($this->product->category_id);

$cat_name = $category->{'name_' . $lang};

$slideshow = '';
$slideshow_nav = '';

$images_path = $this->image_product_path . '/';

if(count($this->images))
{
	foreach($this->images as $i => $image)
	{
		$image_title = $image->_title.' - '.($i + 1);
		
		
		$slideshow .= '<li><div class="uk-overlay uk-overlay-hover">'
								. JHtml::image($images_path.$image->image_full, $image_title)
								. '<div class="uk-overlay-panel uk-overlay-hover uk-overlay-fade uk-overlay-background uk-overlay-icon fl-zoom"></div>'
								. JHtml::link($images_path.$image->image_name, '<span hidden>' . $image_title . '</span>', 'class="uk-position-cover" itemprop="image" data-uk-lightbox="{group:\'g1\'}"')
								. '</li>';

		
		// $slideshow_nav .= '<li data-uk-slideshow-item="'.$i.'">'
										// . '<a href="">'
										// . JHtml::image($images_path.$image->image_thumb, ($i + 1), 'width="50" height="50"')
										// . '</a></li>';

		
		$slideshow_nav .= '<li data-uk-slideshow-item="'.$i.'">'
										. '<a href="">'
										. JHtml::image($images_path.$image->image_thumb, ($i + 1), 'width="50" height="50"')
										. '</a></li>';
	}
}
else
{
	$no_image = $images_path . '/' . $this->noimage;
	$alt = 'Изображение временно не доступно';
	$no_image = JHtml::image($no_image, $alt);
}

if($item->label_id)
{
	$label = '<span class="fl-product-label">' . $item->_label_name . '</span>';
}

$fields = '';

$prints = array();

if($this->attributes[2])
{
	foreach($this->attributes[2]->values as $value)
	{
		$prints[] = JHTML::_('select.option', $value->val_id, $value->name, ['selected' => true]);
	}
}

$p_attribs = [
	'id' => 'shop_attr_id2',
	'class' => 'inputbox',
	'size' => '1',
	'onchange' => 'setAttrValue("2", this.value);',
];



if(is_array($item->extra_field))
{
	foreach($item->extra_field as $field)
	{
		switch($field['id'])
		{
			
			case '1':
				$prop = ' itemprop="material"';
				break ;
			case '15':
				$prop = ' itemprop="color"';
				break ;
			case '6':
				$prop = ' itemprop="material"';
				break ;
			case '10':
				continue 2;
				break ;
			default:
				$prop = '';
				break ;
		}
		
		
		// $fields .= '<tr><td class="uk-text-bold">'.$field['name'].': (' .$field['id']. ')</td><td' . $prop .'>' . $field['value'] . $field['description'] . '</td></tr>';
		$fields .= '<tr><td class="uk-text-bold">'.$field['name'].'</td><td' . $prop .'>' . $field['value'] . $field['description'] . '</td></tr>';
	}
}
$price = (float)$item->product_price;
$quantity = (float)$item->product_quantity;

?>
<article class="fl-product" itemscope itemtype="https://schema.org/Product">
	<div class="uk-h1 fl-product-title">
		<?php echo $label; ?><h1 itemprop="name"><?php echo $item->name; ?></h1>
	</div>
	<link itemprop="url" href="<?php echo JUri::current(); ?>">
	<div class="uk-grid uk-grid-small" data-uk-grid-margin>
		<div class="uk-panel uk-width-small-1-3 uk-width-medium-1-2 uk-text-center">
			<div class="fl-slideshow-wrapper">
				<?php if(count($this->images)): ?>
					<div class="uk-slidenav-position" data-uk-slideshow>
						<ul class="uk-slideshow fl-slideshow-product">
							<?php echo $slideshow; ?>
						</ul>
						<?php if(count($this->images) < 0): ?>
							<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
							<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
						<?php endif; ?>
						<?php if(count($this->images) > 1): ?>
							<ul class="uk-thumbnav uk-margin-small-top uk-flex  uk-flex-center">
								<?php echo $slideshow_nav; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php else : ?>
					<div class="uk-text-center"><?php echo $no_image; ?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="uk-width-small-2-3 uk-width-medium-1-2">
			<?php if (count($this->related_prod)):?>
			<div class="fl-product-related">
				<ul class="uk-thumbnav uk-margin-small-top">
				<?php foreach($this->related_prod as $k => $related) : ?>
					<li itemprop="isSimilarTo" itemscope itemtype="https://schema.org/Product">
						<a itemprop="url" href="<?php echo $related->product_link; ?>" title="<?php echo $related->name; ?>">
							<span itemprop="name" hidden><?php echo $related->name; ?></span>
							<img itemprop="image" src="<?php echo $related->image; ?>" alt="<?php echo $related->name; ?>" width="50" height="50">
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="fl-product-details">
			<table class="uk-table uk-table-middle">
				<?php if($item->manufacturer_code): ?>
				<tr>
					<td class="uk-text-bold">Артикул:</td><td itemprop="productID sku identifier" class="fl-text-upper"><?php echo $item->manufacturer_code; ?></td>
				</tr>
				<?php endif; ?>
				<?php if($item->manufacturer_info->name) : ?>
				<tr itemprop="brand manufacturer" itemscope itemtype="https://schema.org/Organization">
					<td class="uk-text-bold">Бренд:</td><td itemprop="name"><?php echo $item->manufacturer_info->name; ?></td>
					<?php if($item->manufacturer_info->manufacturer_url) : ?>
						<link itemprop="url" href="<?php echo $item->manufacturer_info->manufacturer_url; ?>">
						<?php if($item->manufacturer_info->manufacturer_logo) : ?>
							<link itemprop="logo" href="<?php echo $this->config->image_manufs_live_path .'/'. $item->manufacturer_info->manufacturer_logo; ?>">
						<?php endif; ?>
					<?php endif; ?>
				</tr>
				<?php endif; ?>
				<?php echo $fields; ?>
				<?php //var_dump($item); ?>
				<?php if((float)$item->product_weight): ?>
				<tr>
					<td class="uk-text-bold">Вес:</td><td itemprop="weight"><?php echo (float)$item->product_weight; ?> г.</td>
				</tr>
				<?php endif; ?>
			</table>
			
			<form id="order" class="uk-form uk-form-horizontal" action="<?php echo $this->action?>" enctype="multipart/form-data" autocomplete="off">
			<div class="order">
				<?php if($this->attributes[1]) : ?>
					<?php //var_dump($attribut); ?>
					
					<input type="hidden" name="quantity" id="quantity" />
					<input type="hidden" name="jshop_attr_id[1]" id="jshop_attr_id_1" />
					
					<?php if($prints) : ?>
					<input type="hidden" name="jshop_attr_id[2]" id="jshop_attr_id_2" />
					<?php endif; ?>
					
					<table class="uk-table uk-text-center" id='block_attr_sel_<?php echo $attribut->attr_id?>'>
						<tr>
							<th><?php echo $attribut->attr_name?></th>
							<th>Артикул</th>
							<th>Цена</th>
							<th>Количество</th>
							<?php if($prints) : ?>
							<th>Нанесение</th>
							<?php endif; ?>
							<th></th>
						</tr>
						<?php foreach($this->attributes[1]->values as $value) : 
							
							$val = $value->val_id;
						
						?>
						<tr itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<td class="fl-min-td">
								<b><?php echo $value->name; ?></b>
								<link itemprop="url" href="<?php echo JUri::current(); ?>">
							</td class="fl-min-td">
							<td class="fl-min-td" itemprop="sku identifier"><?php echo $value->manufacturer_code; ?></td>
							<td class="fl-min-td">
								<span itemprop="price" class="fl-product-price"><?php echo ($price + $value->addprice); ?></span>
								<meta itemprop="priceCurrency" content="RUB">
							</td>
							<td class="fl-min-td">
								<?php 
								$count = (float)$value->count;
								
								$disabled = $count ? '' : 'disabled';
								
								$availability = ($count > 0) ? 'InStock' : 'PreOrder';
								
								echo '<link itemprop="availability" href="http://schema.org/'.$availability.'" />';
								?>
								<input type="number" id="quantity_<?php echo $val; ?>" name="quantity_<?php echo $val; ?>" placeholder="<?php echo $count; ?>" min="0" max="<?php echo $count; ?>">
							</td>
							<?php if($prints) : ?>
							<td class="fl-min-td">
								<?php  
								$p_attribs['id'] = 'jshop_attr_id2_' . $val;
								
								echo JHTML::_('select.genericlist', $prints, 'jshop_attr_id2_' . $val, $p_attribs, 'value', 'text', array_key_first($this->attributes[2]->values));
								?>
							</td>
							<?php endif; ?>
							<td class="fl-min-td">
								<button type="submit" class="uk-button fl-button-buy" onclick="
									jQuery('#jshop_attr_id_1').val('<?php echo $val; ?>');
									jQuery('#jshop_attr_id_2').val(jQuery('#jshop_attr_id2_<?php echo $val; ?>').val());
									jQuery('#quantity').val(jQuery('#quantity_<?php echo $val; ?>').val());
									jQuery('#to').val('cart');"
									<?php echo $disabled; ?>></button>
								<button type="submit" class="uk-button fl-button-wish" onclick="jQuery('#to').val('wishlist');jQuery('#to').val('wishlist')"
								<?php echo $disabled; ?>></button>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<table class="uk-table uk-text-center" id=''>
						<tr>
							<th>Цена</th>
							<th>Количество</th>
							<?php if($prints) : ?>
							<th>Нанесение</th>
							<?php endif; ?>
							<th></th>
						</tr>
						<tr itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<td class="fl-min-td">
								<span itemprop="price" class="fl-product-price"><?php echo $price; ?></span>
								<meta itemprop="priceCurrency" content="RUB">
								<meta itemprop="sku identifier" content="<?php echo $item->manufacturer_code; ?>">
								<link itemprop="url" href="<?php echo JUri::current(); ?>">
							</td>
							<td class="fl-min-td">
								<?php 
								// $count = (float)$value->count;
								// $availability = ($count > 0) ? 'InStock' : 'PreOrder';
								
								$disabled = ($quantity > 0) ? '' : 'disabled';
								$availability = ($quantity > 0) ? 'InStock' : 'PreOrder';
								echo '<link itemprop="availability" href="http://schema.org/'.$availability.'" />';
								?>
								<input type="number" id="quantity" name="quantity" placeholder="<?php echo $quantity; ?>" min="0" max="<?php echo $quantity; ?>" onkeyup="reloadPrices();">
							</td>
							<?php if($prints) : ?>
							<td class="fl-min-td">
								<?php echo JHTML::_('select.genericlist', $prints, 'jshop_attr_id[2]', $p_attribs, 'value', 'text', array_key_first($this->attributes[2]->values)); ?>
							</td>
							<?php endif; ?>
							<td class="fl-min-td">
								<button type="submit" class="uk-button fl-button-buy" onclick="jQuery('#to').val('cart');" <?php echo $disabled; ?>></button>
								<button type="submit" class="uk-button fl-button-wish" onclick="jQuery('#to').val('wishlist');" <?php echo $disabled; ?>></button>
							</td>
						</tr>
					</table>
				<?php endif; ?>
					</div>
				<input type="hidden" name="to" id='to' value="cart" />
				<input type="hidden" name="product_id" id="product_id" value="<?php echo $this->product->product_id?>" />
				<input type="hidden" name="category_id" id="category_id" value="<?php echo $this->category_id?>" />
			</form>
			
			<?php if($item->description) : ?>
			<hr>
			<div class="fl-block-text" itemprop="description">
				<?php echo $item->description; ?>
			</div>
			<?php endif; ?>
			
			<?php
			$shop_link = SEFLink('index.php?Itemid=' . getShopMainPageItemid(), 1);
			
			foreach($item->product_categories as $cat)
			{
				$cat_link =  SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id='.$cat->category_id, 1);
				
				echo '<meta itemprop="category" content="' . trim(str_replace($shop_link, '', $cat_link), '/') . '">';
			}
			?>
			</div>
		</div>
	</div>
</article>
