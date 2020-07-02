<?php

defined('_JEXEC') or die;

// JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

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

?>
<article class="" itemscope itemtype="https://schema.org/Article">
	<h1 class="" itemprop="title"><?php echo $title; ?></h1>
	<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
	<?php if($text) : ?>
	<div itemprop="articleBody"><?php echo $text; ?></div>
	<?php endif; ?>
</article>