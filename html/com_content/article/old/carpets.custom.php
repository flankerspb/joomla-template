<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

// FlTemplate::addScript('uikit/lightbox.js', array('version' => 'auto', 'relative' => true));

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
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

$header = array();
$header['main'] = $title;

?>
<article class="fl-article-carpet" itemscope itemtype="https://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<div class="fl-custom-carpets-article uk-block-large"  itemprop="articleBody">
	<div class="uk-container uk-container-center">
		<?php if($text) : ?>
			<div class="fl-block-text fl-alt-h-color">
				<?php echo $text; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
</article>