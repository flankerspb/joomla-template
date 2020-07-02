<?php 
defined('_JEXEC') or die('Restricted access');


$config = JSFactory::getConfig();


$description = $this->category->description;

$title = $this->params->get('page_heading', $this->params->get('page_title'));

$all_cats = getAllCategories(1, 1, 1);

print $this->_tmp_maincategory_html_start;
?>
<div class="" itemscope itemtype="http://schema.org/ItemList">
	<h1 class="uk-text-center" itemprop="name"><?php echo $title; ?></h1>
	<link itemprop="url" href="<?php echo JUri::current(); ?>">
	<?php
	if($description)
	{
		echo '<div>' . $description . '</div>';
	}
	?>
	<?php if(count($this->categories)) : ?>
	<ul class="uk-grid uk-grid-collapse uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-medium-1-6 uk-text-center uk-flex uk-flex-center" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
		
		<?php foreach($this->categories as $item) :
			
			static $i = 0;
			$i++;
			
			if($item->category_image && file_exists($config->image_category_path .'/'. $item->category_image))
			{
				$image = $this->image_category_path .'/'. $item->category_image;
				$alt = $item->name;
			}
			else
			{
				$image = $this->image_category_path .'/'. $this->noimage;
				$alt = 'Изображение временно не доступно';
			}
			
			$image = 'content/source/shirt.png';
			
			$image_attribs = array();
			$image_attribs['class'] = 'fl-image-teaser';
			$image_attribs['itemprop'] = 'image';
			
			$image = JHtml::image($image, $alt, $image_attribs);
			
			$link_attribs = array();
			// $link_attribs['class'] = 'uk-position-cover';
			$link_attribs['itemprop'] = 'url';
			
			$link = JHtml::link($item->category_link, $image . '<div>' . $item->name . '</div>', $link_attribs);
			
		?>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
			<meta itemprop="position" content="<?php echo $i; ?>">
			<div class="uk-panel uk-panel-body tm-panel-hover uk-text-center">
				<?php echo $link; ?>
				<ul class="uk-list uk-text-left">
					<?php foreach($all_cats[$item->category_id] as $sub_item) :
					
					$sub_link = JHtml::link($sub_item->category_link, $sub_item->name);
					?>
					<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<?php echo $sub_link; ?>
					</li>
					<?php  endforeach; ?>
				</ul>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif; ?>
	
	<?php print $this->_tmp_maincategory_html_end;?>
</div>