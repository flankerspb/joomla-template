<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

FlTemplate::addScript('uikit/lightbox.js', array('version' => 'auto', 'relative' => true));
FlTemplate::addScript('uikit/slideshow.js', array('version' => 'auto', 'relative' => true));

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

$title = $this->escape($this->item->title);
$text = trim($this->item->text);

$props = array();
$code = '';

$default_image_path = trim(JComponentHelper::getParams('com_media')->get('image_path'), '/');

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
							$default_image_path,
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
	foreach($images as $image)
	{
		static $i = 0;
		
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
}
else
{
	$image = 'images/no-image-carpet.jpg';
	$alt = 'Изображение временно не доступно';
	$no_image = JHtml::image($image, $alt);
}

$header = array();
$header['top1'] = $this->item->parent_title;
$header['top2'] = $this->item->category_title;
$header['main'] = $title;

?>
<article class="fl-article-carpet" itemscope itemtype="https://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<div class="fl-collection-article uk-block-large"  itemprop="articleBody">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-width-1-1">
			<div class="fl-block-images uk-panel uk-width-small-1-3 uk-width-medium-1-2">
				<?php if($images): ?>
					<div class="uk-slidenav-position" data-uk-slideshow>
						<ul class="uk-slideshow">
							<?php echo $slideshow; ?>
						</ul>
						<?php if(count($images) < 0): ?>
							<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
							<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
						<?php endif; ?>
						<?php if(count($images) > 1): ?>
							<ul class="uk-thumbnav uk-margin-small-top uk-flex  uk-flex-center">
								<?php echo $slideshow_nav; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php else : ?>
					<div class="uk-text-center"><?php echo $no_image; ?></div>
					<p class="uk-h4 uk-margin-remove uk-text-center"><?php echo $alt; ?></p>
				<?php endif; ?>
				<?php if($this->item->featured): ?>
					<div class="uk-badge uk-badge-danger fl-instock">В наличии</div>
				<?php endif; ?>
			</div>
			<div class="fl-block-props uk-width-small-2-3 uk-width-medium-1-2">
				<h2 class="uk-h1" itemprop="title"><?php echo $title; ?></h2>
				<table class="uk-table">
					<?php if($code): ?>
					<tr>
						<td class="uk-text-bold">Артикул:</td><td><?php echo $code; ?></td>
					</tr>
					<?php endif; ?>
					<tr>
						<td class="uk-text-bold">Тип:</td><td><?php echo $this->item->category_title; ?></td>
					</tr>
						<?php foreach($props as $prop)
						{
							echo '<tr><td class="uk-text-bold">'.$prop->title.':</td><td>'.$prop->value.'</td></tr>';
						}
						?>
				</table>
				<?php if($text) : ?>
				<hr>
				<div class="fl-block-text">
					<?php echo $text; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</article>
