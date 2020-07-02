<?php

defined('_JEXEC') or die('Restricted access');


$show_title = JFactory::getApplication()->getMenu()->getActive()->params->get('show_page_heading', 1);

$cats = getAllCategories();
$active = JRequest::getInt('category_id');

$products_list_class = 'uk-grid-width-1-2 uk-grid-width-small-1-3 fl-view-grid';
// $products_list_class = 'uk-grid-width-1-1';

echo $this->_tmp_category_html_start;

$this->list_name = $this->category->name;

?>
<div class="">
	<div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
		<aside class="uk-width-1-5 uk-hidden-small" itemscope itemtype="http://schema.org/OfferCatalog">
			<nav class="uk-panel fl-panel-tab">
				<?php 
				$menu = '';
				
				foreach($cats[0] as $key => $value)
				{
					if($value->active)
					{
						
						$menu .= '<span class="uk-panel-title" itemprop="name"><a itemprop="url" href="'.$value->link.'">'.$value->name.'</a></span>';
						
						// $menu .= '<meta itemprop="name" content="'.$value->name.'">';
						// $menu .= '<link itemprop="url" href="'.$value->link.'">';
						if($cats[$key])
						{
							$menu .= '<ul class="uk-tab uk-tab-left">';
							
							foreach($cats[$key] as $k => $v)
							{
								static $i = 0;
								$i++;
								
								$item_class = ($k == $active) ? 'class="uk-active"' : '';
								$item_title = '<span itemprop="name">' .$v->name. '</span>';
								
								$menu .=
									'<li '.$item_class.' itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">'
									//'<meta itemprop="position" content="' . $i . '">',
									. JHtml::link($v->link, $item_title, 'itemprop="url"')
									. '</li>';
							}
							$menu .= '</ul>';
						}
						break;
					}
				}
				
				echo $menu;
				?>
			</nav>
		</aside>
		<div class="uk-width-1-1 uk-width-medium-4-5">
			<div class="uk-flex uk-flex-middle uk-flex-space-between uk-margin-bottom">
				<div>
					<div class="uk-flex fl-shop-category-title">
						<h1><?php echo $this->category->name; ?></h1>
						<div class="uk-h1 uk-text-muted uk-margin-small-left">(<?php echo $this->total; ?>)</div>
					</div>
				</div>
				<form action="<?php echo $this->action;?>" method="post" name="sort_count" id="sort_count" class="uk-form">
					<input type="hidden" name="orderby" id="orderby" value="<?php echo $this->orderby?>" />
					<input type="hidden" name="limitstart" value="0" />
					<?php echo $this->sorting; ?>
					
					<?php if ($this->config->show_count_select_products) : ?>
						<?php echo $this->product_count; ?>
					<?php endif; ?>
				</form>
			</div>
			<?php
			if($this->category->description)
			{
				echo '<div class="category_description">' , $this->category->description . '</div>';
			}
			else
			{
				echo '<div class="category_description uk-margin-bottom">Брендированные ' . $this->category->name . ' популряны уже на протяжении нескольких лет, а значит станут не только приятным копроративным подарком, но и полезным предметом, который с удовольствием будут использовать.</div>';
			}
			
			
			?>
			<?php print $this->_tmp_category_html_before_products;?>
			<?php include(__DIR__ .'/products.php');?>
		</div>
	</div>
	
	<?php print $this->_tmp_category_html_end;?>
</div>