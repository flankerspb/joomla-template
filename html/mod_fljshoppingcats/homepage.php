<?php

defined('_JEXEC') or die();

$config = JSFactory::getConfig();

if($params->get('root'))
{
	$url = SEFLink('index.php?option=com_jshopping&controller=category&task=view&category_id='. $params->get('root'), 1);
}
else
{
	$url = SEFLink('index.php?option=com_jshopping&view=category', 1);
}

$title = $params->get('title_link') ? JHtml::link($url, $module->title) : $module->title;

?>
<div class="uk-block">
	<div class="uk-container uk-container-center" itemscope itemtype="http://schema.org/ItemList">
		<h2 itemprop="name" class="uk-text-center"><?php echo $title; ?></h2>
		<link itemprop="url" href="<?php echo $url; ?>">
		<ul class="uk-grid uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-medium-1-6 uk-flex uk-flex-center" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
		<?php foreach($categories[$params->get('root')] as $item) :
					
					static $i = 0;
					$i++;
					
					if($item->image && file_exists($config->image_category_path .'/'. $item->image))
					{
						$image = $config->image_category_live_path .'/'. $item->image;
					}
					else if(file_exists($config->image_category_path .'/'. $item->alias .'.png'))
					{
						$image = $config->image_category_live_path .'/'. $item->alias .'.png';
					}
					else
					{
						$image = $config->image_category_live_path .'/'. $config->noimage;
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
					
					$link = JHtml::link($item->link, '<span class="uk-hidden">' . $item->name . '</span>', $link_attribs);
		?>
			<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<meta itemprop="position" content="<?php echo $i; ?>">
				<div class="uk-panel uk-panel-body tm-panel-hover uk-text-center">
					<?php echo $image; ?>
					<h3 class="uk-panel-title tm-title-link" itemprop="name"><?php echo $item->name; ?></h3>
					<?php echo $link; ?>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
</div>