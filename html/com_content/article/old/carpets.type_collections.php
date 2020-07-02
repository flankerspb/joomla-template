<?php

defined('_JEXEC') or die;

$limit = 6;

$catid = $this->collections;
$cat = JCategories::getInstance('content')->get($catid);

$db = JFactory::getDbo();
$query = $db->getQuery(true);

$query->select('id, alias, title, catid');
$query->from('#__content');
$query->where('catid=' . $catid);
$query->where('state=1');
$query->order('title');

$db->setQuery($query, 0, $limit);
$items = $db->loadObjectList('id');

$images_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');

if(count($items)) :

?>
<hr>
<div class="uk-block">
	<h2 class="uk-text-center"><?php echo JHtml::link('index.php?option=com_content&view=category&id='.$catid, 'Наша коллекция'); ?></h2>
	<ul class="uk-block uk-flex uk-flex-center uk-grid uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" data-uk-grid-margin data-uk-grid-match="{row: false, target:'h3'}">
<?php

	foreach($items as $item) :

		static $i = 1;
		
		if($i > $limit) break;
		
		$title = htmlspecialchars($item->title);
		
		$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
		
		$link_attribs = array();
		$link_attribs['class'] = 'uk-position-cover';
		
		$link = JHtml::link($url, '<span class="uk-hidden">' . $item->title . '</span>', $link_attribs);
		
		$image = implode('/', array(
									$images_path,
									$cat->path,
									$item->alias,
									'00.jpg'
		));
		
		$image_attribs = array();
		$image_attribs['title'] = $title;
		$image_attribs['class'] = 'uk-overlay-scale';
		
		if(file_exists(JPATH_ROOT.'/' . $image))
		{
			$alt = $title;
		}
		else
		{
			$image ='images/no-image-carpet.jpg';
			$alt = 'Изображение временно не доступно';
		}
		
		$image = JHtml::image($image, $alt, $image_attribs);
		
		$i++;

?>
	<li>
		<div class="uk-panel fl-linked-panel uk-text-center">
			<div class="uk-overlay uk-overlay-hover fl-panel-shadow">
				<?php echo $image; ?>
				<div class="uk-block uk-flex uk-flex-middle uk-flex-center fl-collection-item-header">
					<h3 class="uk-h4 fl-link uk-flex uk-flex-middle uk-flex-center"><?php echo $title; ?></h3>
				</div>
				<?php echo $link; ?>
			</div>
		</div>
	</li>
<?php endforeach; ?>
	</ul>
	<div class="uk-margin-top uk-text-center">
	<?php echo JHtml::link('index.php?option=com_content&view=category&id='.$catid, 'Посмотреть все ковры', 'class="uk-button uk-button-large"'); ?>
	</div>
</div>
<?php endif; ?>