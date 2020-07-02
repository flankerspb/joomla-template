<?php

defined('_JEXEC') or die;

$limit = 5;

$catid = $this->portfolio;
$cat = JCategories::getInstance('content')->get($catid);

$db = JFactory::getDbo();
$query = $db->getQuery(true);

$query->select('id, alias, title, catid');
$query->from('#__content');
$query->where('catid='. $catid);
$query->where('state=1');
$query->order('title');

$db->setQuery($query, 0, $limit);
$items = $db->loadObjectList('id');

$images_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');
$default_image = '/no-image-carpet.jpg';
$images = '';



if(count($items)) :
	foreach($items as $item)
	{
		$image = implode('/', array(
									$images_path,
									$cat->path,
									$item->alias,
									'00.jpg'
		));
		
		if(file_exists(JPATH_ROOT.'/' . $image))
		{
			$alt = $title;
		}
		else
		{
			$image = $images_path.$default_image;
			$alt = 'Изображение временно не доступно';
		}
		
		$images .= '<li><div class="uk-overlay uk-overlay-hover">'
								. JHtml::image($image, $alt)
								. '<div class="uk-overlay-panel uk-overlay-hover uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>'
								. JHtml::link($image, '<span class="uk-hidden">'.$item->title.'</span>', 'class="uk-position-cover"  data-uk-lightbox="{group:\'g1\'}"')
								. '</li>';
	}
?>
<hr>
<div class="uk-block">
	<h2 class="uk-text-center"><?php echo JHtml::link('index.php?option=com_content&view=category&id='.$catid, 'Портфолио'); ?></h2>
	<ul class="uk-block uk-flex uk-flex-center uk-grid uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid-margin>
		<?php echo $images; ?>
	</ul>
	<div class="uk-margin-top uk-text-center">
	<?php echo JHtml::link('index.php?option=com_content&view=category&id='.$catid, 'Посмотреть другие работы', 'class="uk-button uk-button-large"'); ?>
	</div>
</div>
<?php endif;
