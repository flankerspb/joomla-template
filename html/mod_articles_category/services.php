<?php

defined('_JEXEC') or die;

$cats = $params->get('catid');

$url = JRoute::_(ContentHelperRoute::getCategoryRoute($cats[0]));

$title = JHtml::link($url, $list[0]->category_title);

?>
<div class="uk-block <?php echo $moduleclass_sfx; ?>">
	<div class="uk-container uk-container-center" itemscope itemtype="http://schema.org/ItemList">
		<h2 class="uk-text-center"><?php echo $title; ?></h2>
		<link itemprop="url" href="<?php echo $url; ?>">
		<ul class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
		<?php foreach ($list as $item) :
					
					static $i = 0;
					$i++;
					
					$images = json_decode($item->images);
					
					if($images->image_intro && file_exists(JPATH_ROOT .'/'. $images->image_intro))
					{
						$image = $images->image_intro;
						$alt = $item->title;
					}
					else if(file_exists(JPATH_ROOT .'/content/images/services/'. $item->alias . '.png'))
					{
						$image = 'content/images/services/'. $item->alias . '.png';
						$alt = $item->title;
					}
					else
					{
						$image = 'content/images/services/_noimage.png';
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
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<meta itemprop="position" content="<?php echo $i; ?>">
				<div class="uk-panel uk-panel-box uk-panel-box-primary uk-text-center tm-panel-hover">
					<?php echo $image; ?>
					<h3 class="uk-panel-title" itemprop="name"><?php echo $item->title; ?></h3>
					<?php echo $link; ?>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>
