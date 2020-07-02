<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$lang    = ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language;

$published = true;
$warinings = array();

if($this->item->state == 0)
{
	$published = false;
	$warinings[] = '<span class="label label-warning">' . JText::_('JUNPUBLISHED') . '</span>';
}
if(strtotime($this->item->publish_up) > strtotime(JFactory::getDate()))
{
	$published = false;
	$warinings[] = '<span class="label label-warning">' . JText::_('JNOTPUBLISHEDYET') . '</span>';
}
if((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())
{
	$published = false;
	$warinings[] = '<span class="label label-warning">' . JText::_('JEXPIRED') . '</span>';
}

$type = $this->escape($this->params->get('page_heading'));
$collection = $this->escape($this->item->category_title);
$title = $this->escape($this->item->title);
$text = trim($this->item->text);

$props = array();
$code = '';

foreach($this->item->jcfields as $field)
{
	switch($field->name)
	{
		case 'code' :
			$code = trim($field->value);
			break;
		default :
			$data = new stdClass();
			$data->title = $field->title;
			$data->value = trim($field->value);
			$props[$field->name] = $data;
	}
}

$images_path = implode('/', array(
							trim(JComponentHelper::getParams('com_media')->get('image_path'), '/'),
							$this->item->parent_route,
							$this->item->category_alias,
							$this->item->alias,
							''
));

if(JFolder::exists(JPATH_ROOT.'/'.$images_path))
{
	$images = JFolder::files(JPATH_ROOT.'/'.$images_path , '.jpg$');
	
	$slideshow = '';
	$slideshow_nav = '';
}

if($images)
{
	$i = 0;
	
	foreach($images as $image)
	{
		$slideshow .= '<li><div class="uk-overlay uk-overlay-hover">'
								. JHtml::image($images_path.$image, $title.' - '.($i + 1))
								. '<div class="uk-overlay-panel uk-overlay-hover uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>'
								. JHtml::link($images_path.$image, $img, 'class="uk-position-cover"  data-uk-lightbox="{group:\'g1\'}"')
								. '</li>';

		
		$slideshow_nav .= '<li data-uk-slideshow-item="'.$i.'">'
										. '<a href="">'
										. JHtml::image($images_path.$image, ($i + 1), 'width="50" height="50"')
										. '</a></li>';
		
		$i++;
	}
	
	JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

	FlTemplate::addScript('uikit/lightbox.js', array('version' => 'auto', 'relative' => true));
	
	if($i > 0)
	{
		FlTemplate::addScript('uikit/slideshow.js', array('version' => 'auto', 'relative' => true));
	}
}
else
{
	$image = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/').'/no-image-carpet.jpg';
	$alt = 'Изображение временно не доступно';
	$no_image = JHtml::image($image, $alt);
}

$header = array();
$header['top'] = $this->item->category_title;
$header['main'] = $title;

?>
<article class="fl-article-carpet" itemscope itemtype="https://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<div class="fl-portfolio-article uk-block-large"  itemprop="articleBody">
	<div class="uk-container uk-container-center">
		<?php if($images): ?>
		<div class="fl-block-images uk-container-center" data-uk-slideshow>
			<div class="uk-slidenav-position">
				<ul class="uk-slideshow">
					<?php echo $slideshow; ?>
				</ul>
				<?php if(count($images) < 0): ?>
					<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
					<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
				<?php endif; ?>
			</div>
			<?php if(count($images) > 1): ?>
				<ul class="uk-thumbnav uk-margin-small-top uk-flex  uk-flex-center">
					<?php echo $slideshow_nav; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php else : ?>
		<div class="fl-block-images uk-container-center">
			<div class="uk-text-center"><?php echo $no_image; ?></div>
			<p class="uk-h4 uk-margin-remove uk-text-center"><?php echo $alt; ?></p>
		</div>
		<?php endif; ?>
		<?php if($text) : ?>
		<hr>
		<div class="fl-block-text">
			<?php echo $text; ?>
		</div>
		<?php endif; ?>
	</div>
</div>
</article>
