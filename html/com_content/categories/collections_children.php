<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Params
$show_images = $this->params->get('show_description_image');

$count = 0;

$default_image_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');

$default_image = '/no-image-carpet.jpg';

$image_path = implode('/', array(
							trim(JComponentHelper::getParams('com_media')->get('image_path'), '/'),
							$this->parent->path,
							''
));

$items = $this->items[$this->parent->id];

if ($this->maxLevelcat != 0 && count($items) > 0) :
?>
<div class="latin">
<?php

	foreach ($items as $id => $item) :
		
		$title = $this->escape($item->title);
		
		$image = $show_images ? $item->getParams()->get('image') : null;
		
		$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
		
		$link_attribs = array();
		$link_attribs['class'] = 'uk-position-cover';
		$link_attribs['itemprop'] = 'url';
		
		$link = JHtml::link($url, '<span class="uk-hidden">' . $title . '</span>', $link_attribs);
		
		$count++;
		
		$image_attribs = array();
		$image_attribs['title'] = $title;
		$image_attribs['class'] = 'uk-overlay-scale';
		
		if(file_exists(JPATH_ROOT.'/' . $image_path . $item->alias . '.jpg'))
		{
			$image = $image_path . $item->alias . '.jpg';
			
			$image_attribs['itemprop'] = 'image';
			
			$alt = htmlspecialchars($item->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8');
			
			$alt = $alt ? $alt : $title;
		}
		else
		{
			$image = $default_image_path.$default_image;
			$alt = 'Изображение временно не доступно';
			$image_attribs['title'] = $title;
		}
		
		// $image = JHtml::image($image, $alt, $image_attribs);
		
	?>
		
	<div class="uk-margin-top" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<meta itemprop="position" content="<?php echo $count; ?>">
		<div class="fl-collection uk-overlay uk-overlay-hover uk-contrast fl-linked-panel fl-panel-shadow" itemprop="item" itemscope itemtype="https://schema.org/Thing">
			<div class="uk-overlay-scale fl-panel-image" style="background-image: url(<?php echo $image; ?>);"></div>
			<div class="uk-text-right uk-overlay-panel uk-overlay-bottom uk-ignore">
				<h3 class="uk-h1 fl-link uk-margin-remove" itemprop="name"><?php echo $title; ?></h3>
			</div>
			<?php echo $link; ?>
		</div>
	</div>
	
	<?php endforeach; ?>
</div>
<?php else : ?>
<div class="uk-text-center">
	<img src="/content/images/underconstract.png" alt="Раздел в разработке">
	<p class="uk-text-large uk-text-bold uk-text-muted">Раздел в разработке</p>
</div>
<?php endif; ?>
