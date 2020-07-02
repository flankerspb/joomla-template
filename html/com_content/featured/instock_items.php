<?php


defined('_JEXEC') or die;

$count = $this->pagination->limitstart + 1;

$default_image_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');

foreach($this->lead_items as &$item) : 
	
	$title = $item->alternative_readmore ? $item->alternative_readmore : $item->title;
	
	$image_path = implode('/', array(
								$default_image_path,
								$item->category_route,
								$item->alias
));
	
	$image_attribs = array();
	
	if(file_exists(JPATH_ROOT.'/'.$image_path . '/00.jpg'))
	{
		$image = $image_path . '/00.jpg';
		
		$alt = $item->title;
	}
	else
	{
		$image = 'images/no-image-carpet.jpg';
		$alt = 'Изображение временно не доступно';
		$image_attribs['title'] = $title;
	}
	
	$image_attribs['class'] = 'uk-overlay-scale';
	$image_attribs['itemprop'] = 'image';
	
	$thumbs =  array();
	
	for($i = 0; $i < 3; $i++)
	{
		if(file_exists(JPATH_ROOT.'/'.$image_path . '/0'.$i.'.jpg'))
		{
			$thumbs[] =  JHtml::image($image_path . '/0'.$i.'.jpg', $alt);
		}
	}
	
	$image = JHtml::image($image, $alt, $image_attribs);
	
	$url = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));
	
	$link_attribs = array();
	$link_attribs['class'] = 'uk-position-cover';
	$link_attribs['itemprop'] = 'url';

	$link = JHtml::link($url, '<span class="uk-hidden">' . $title . '</span>', $link_attribs);
	
	$props = array();
	$code;
	$material;
	
	foreach($item->jcfields as $field)
	{
		switch($field->name)
		{
			case 'code' :
				$code = trim($field->value);
				break;
			case 'material' :
				$material = trim($field->value);
				break;
			default :
				$data = new stdClass();
				$data->title = $field->title;
				$data->value = trim($field->value);
				$props[$field->name] = $data;
		}
	}
	
?>
<div class="<?php echo $class; ?>">
	<div class="item-carpet" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
		<meta itemprop="position" content="<?php echo $count++; ?>">
		<div class="uk-panel fl-linked-panel uk-text-center" itemprop="item" itemscope itemtype="https://schema.org/Thing">
			<div class="uk-overlay uk-overlay-hover fl-panel-shadow">
				<div class="img-wrapper">
					<?php echo $image; ?>
				</div>
				<div class="thumbs-wrapper">
					<?php if(count($thumbs)): ?>
					<div class="uk-grid uk-grid-small uk-grid-width-1-3">
						<?php foreach($thumbs as $thumb) echo '<div>'.$thumb.'</div>'; ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="uk-block uk-flex uk-flex-middle uk-flex-center header">
					<h3 class="uk-h4 fl-link uk-flex uk-flex-middle uk-flex-center uk-margin-top-remove" itemprop="name"><?php echo $title; ?></h3>
				</div>
				<?php echo $link; ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
