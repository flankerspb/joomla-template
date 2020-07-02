<?php 
defined('_JEXEC') or die('Restricted access');


$config = JSFactory::getConfig();


$description = $this->category->description;

$title = $this->params->get('page_heading', $this->params->get('page_title'));

print $this->_tmp_maincategory_html_start;
?>
<div class="" itemscope itemtype="http://schema.org/OfferCatalog">
	<h1 class="uk-text-center" itemprop="name"><?php echo $title; ?></h1>
	<link itemprop="url" href="<?php echo JUri::current(); ?>">
	<?php
	if($description)
	{
		echo '<div>' . $description . '</div>';
	}
	?>
	<?php if(count($this->categories)) : ?>
	<ul class="uk-grid uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-medium-1-6 uk-text-center uk-flex uk-flex-center" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
		
		<?php foreach ($this->categories as $item) : 
			
			static $i = 0;
			$i++;
			
			if($item->category_image && file_exists($config->image_category_path .'/'. $item->category_image))
			{
				$image = $this->image_category_path .'/'. $item->category_image;
			}
			else if(file_exists($config->image_category_path .'/'. $item->alias .'.png'))
			{
				$image = $this->image_category_path .'/'. $item->alias .'.png';
			}
			else
			{
				$image = $this->image_category_path .'/'. $this->noimage;
			}
			
			$alt = $item->name;
			
			//$image = 'content/source/shirt.png';
			
			$image_attribs = array();
			$image_attribs['class'] = 'fl-image-teaser';
			$image_attribs['itemprop'] = 'image';
			
			$image = JHtml::image($image, $alt, $image_attribs);
			
			$link_attribs = array();
			$link_attribs['class'] = 'uk-position-cover';
			$link_attribs['itemprop'] = 'url';
			
			$link = JHtml::link($item->category_link, '<span class="uk-hidden">' . $item->name . '</span>', $link_attribs);
			
			
			/* <meta itemprop="position" content="<?php echo $i; ?>"> */
		?>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/OfferCatalog">
			<div class="uk-panel uk-panel-body tm-panel-hover uk-text-center">
				<?php echo $image; ?>
				<h3 class="uk-panel-title tm-title-link" itemprop="name"><?php echo $item->name; ?></h3>
				<?php echo $link; ?>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif; ?>
	
	<?php print $this->_tmp_maincategory_html_end;?>
</div>