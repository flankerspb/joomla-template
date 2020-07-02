<?php

defined('_JEXEC') or die;

$cats = $params->get('catid');

$url = JRoute::_(ContentHelperRoute::getCategoryRoute($cats[0]));

$title = JHtml::link($url, $list[0]->category_title);

?>
<div class="" itemprop="hasOfferCatalog" itemscope itemtype="http://schema.org/OfferCatalog">
	<h2 class="uk-text-center"><?php echo $title; ?></h2>
	<link itemprop="url" href="<?php echo $url; ?>">
	<ul class="uk-grid uk-grid-large uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-medium-1-6 uk-flex uk-flex-center" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
	<?php foreach ($list as $item) :
				
				static $i = 0;
				$i++;
				
				$images = json_decode($item->images);
				
				if($images->image_intro && file_exists(JPATH_ROOT .'/'. $images->image_intro))
				{
					$image = $images->image_intro;
					$alt = $item->title;
				}
				else if(file_exists(JPATH_ROOT .'/content/images/print/'. $item->alias . '.png'))
				{
					$image = 'content/images/print/'. $item->alias . '.png';
					$alt = $item->title;
				}
				else
				{
					$image = 'content/images/print/_noimage.png';
					$alt = JText::_('FL_NO_IMAGE');
				}
				
				$image_attribs = array();
				$image_attribs['class'] = 'fl-image-teaser';
				$image_attribs['itemprop'] = 'image';
				
				$image = JHtml::image($image, $alt, $image_attribs);
				
				$link_attribs = array();
				$link_attribs['class'] = 'uk-position-cover';
				$link_attribs['itemprop'] = 'url';

				$link = JHtml::link($item->link, '<span class="uk-hidden">' . $item->title . '</span>', $link_attribs);
	?>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
			<div class="uk-panel uk-panel-body tm-panel-hover uk-text-center" itemprop="itemOffered" itemscope itemtype="https://schema.org/Service">
				<?php echo $image; ?>
				<h3 class="uk-panel-title tm-title-link" itemprop="name"><?php echo $item->title; ?></h3>
				<?php echo $link; ?>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
</div>

