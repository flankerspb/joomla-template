<?php

defined('_JEXEC') or die;


$title = $this->escape($this->params->get('page_heading'));
$lang = ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language;


//alternativeHeadline
//author
//contentLocation
//contributor
//copyrightHolder
//creator
//headline
//text
//thumbnailUrl
//image

?>
<div class="uk-text-center" itemscope itemtype="http://schema.org/WebSite">
	<h1 itemprop="name" class="fl-main-title"><?php echo $title; ?></h1>
	<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
	<link itemprop="url" href="<?php echo Juri::root(); ?>">
	<?php if($this->item->text) : ?>
		<div itemprop="headline" class="uk-text-large"><?php echo $this->item->text; ?></div>
	<?php endif; ?>
</div>