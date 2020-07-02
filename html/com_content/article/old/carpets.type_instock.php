<?php

defined('_JEXEC') or die;

$limit = 6;

$cats = array();

foreach(explode(',', $this->instock) as $v)
{
	$v = trim($v);
	
	if($v) $cats[$v] = JCategories::getInstance('content')->get($v);
}

foreach(explode(',', $this->collections) as $v)
{
	$v = trim($v);
	
	if($v) $cats[$v] = JCategories::getInstance('content')->get($v);
}

$db = JFactory::getDbo();
$query = $db->getQuery(true);

$query->select('id, alias, title, catid');
$query->from('#__content');
$query->where('catid in ('. implode(',', array_keys($cats)) .')');
$query->where('state=1');
$query->where('featured=1');
$query->order('title');

$db->setQuery($query, 0, $limit);
$items = $db->loadObjectList('id');

// var_dump($items);

$images_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');
$images = '';

if(count($items)) :

?>
<hr>
<div class="uk-block">
	<?php if($this->iteminstock) : ?>
	<h2 class="uk-text-center"><?php echo JHtml::link('index.php?Itemid='.$this->iteminstock, $this->item->title . ' в наличии'); ?></h2>
	<?php else : ?>
	<h2 class="uk-text-center"><?php echo $this->item->title; ?> в наличии</h2>
	<?php endif; ?>
	<ul class="uk-block uk-flex uk-flex-center uk-grid uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" data-uk-grid-margin data-uk-grid-match="{row: false, target:'h3'}">
<?php

	foreach($items as $item) :
		
		$title = htmlspecialchars($item->title);
		
		$image = implode('/', array(
									$images_path,
									$cats[$item->catid]->path,
									$item->alias,
									'00.jpg'
		));
		
		$image_attribs = array();
		
		if(file_exists(JPATH_ROOT.'/' . $image))
		{
			$alt = $title;
		}
		else
		{
			$image = 'images/no-image-carpet.jpg';
			$alt = 'Изображение временно не доступно';
		}
		
		$image_attribs['class'] = 'uk-overlay-scale';
		
		$image = JHtml::image($image, $alt, $image_attribs);
		
		$url = JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid, $item->language));
		
		$link_attribs = array();
		$link_attribs['class'] = 'uk-position-cover';
		
		$link = JHtml::link($url, '<span class="uk-hidden">' . $title . '</span>', $link_attribs);
		
		

?>
	<li>
		<div class="uk-panel fl-linked-panel uk-text-center">
			<div class="uk-overlay uk-overlay-hover fl-panel-shadow">
				<?php echo $image; ?>
				<div class="uk-block uk-flex uk-flex-middle uk-flex-center header">
					<h3 class="uk-h4 fl-link uk-flex uk-flex-middle uk-flex-center" itemprop="name"><?php echo $title; ?></h3>
				</div>
				<?php echo $link; ?>
			</div>
		</div>
	</li>
<?php endforeach; ?>
	</ul>
	<?php if($this->iteminstock) : ?>
	<div class="uk-margin-top uk-text-center">
	<?php echo JHtml::link('index.php?Itemid='.$this->iteminstock, 'Посмотреть все ковры', 'class="uk-button uk-button-large"'); ?>
	</div>
	<?php endif; ?>
</div>
<?php endif;
