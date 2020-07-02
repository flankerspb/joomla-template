<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang  = JFactory::getLanguage();

// Params
$show_images = 1;

$count = 0;

$default_image_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');

$default_image = '/no-image-carpet.jpg';

$image_path = implode('/', array(
								$default_image_path,
								$this->parent->path,
								$this->alias,
								''
));

if(count($this->exclude_cats))
{
	foreach ($this->items[$this->parent->id] as $k => $child)
	{
		if(in_array($child->id, $this->exclude_cats))
		{
			unset($this->items[$this->parent->id][$k]);
		}
	}
}

?>
<div class="latin" itemscope itemtype="https://schema.org/ItemList">
	<link itemprop="url" href="<?php echo JUri::current(); ?>">
	<meta itemprop="name" content="<?php echo $this->escape($this->params->get('page_heading')); ?>">
<?php

foreach ($this->items[$this->parent->id] as $id => $item) :
	
	$title = $this->escape($item->title);
	
	$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
	
	$link_attribs = array();
	$link_attribs['class'] = 'uk-position-cover';
	$link_attribs['itemprop'] = 'url';
	
	$link = JHtml::link($url, '<span class="uk-hidden">' . $title . '</span>', $link_attribs);
	
	$count++;
	
	// $image_attribs = array();
	// $image_attribs['class'] = 'uk-overlay-scale';
	
	if(file_exists(JPATH_ROOT.'/'. $image_path . $item->alias . '.jpg'))
	{
		// $alt = htmlspecialchars($item->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8');
		// $alt = $alt ? $alt : $title;
		
		// $image_attribs['title'] = $title;
		// $image_attribs['itemprop'] = 'thumbnailUrl';
		
		// $image = JHtml::image($image_path . $item->alias . '.jpg', $alt, $image_attribs);
		$image = $image_path . $item->alias . '.jpg';
	}
	else
	{
		// $alt = 'Изображение временно не доступно';
		// $image = JHtml::image($default_image_path.$default_image, $alt, $image_attribs);
		$image = $default_image_path.$default_image;
	}
	

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

