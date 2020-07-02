<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JLoader::register('FlTemplate', JPATH_ROOT . '/templates/2sweb/core/template.php');

// FlTemplate::addScript('uikit/lightbox.js', array('version' => 'auto', 'relative' => true));

// Create shortcuts to some parameters.
$params  = $this->item->params;
$lang    = ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language;

$title = $this->escape($this->item->title);
$introtext = trim(strip_tags($this->item->introtext));
$fulltext = trim($this->item->fulltext);

$header = array();
$header['top'] = $this->item->category_title;
$header['main'] = $title;

foreach($this->item->jcfields as $field)
{
	switch($field->name)
	{
		case 'portfolio' :
			$this->portfolio = trim($field->value);
		break;
		case 'collections' :
			$this->collections = trim($field->value);
		break;
		case 'instock' :
			$this->instock = trim($field->value);
		break;
		case 'item-instock' :
			$this->iteminstock = trim($field->value);
		break;
	}
}

?>
<article class="fl-article-carpet" itemscope itemtype="https://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo $lang; ?>" />
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<div class="fl-collection-article uk-block-large"  itemprop="articleBody">
	<div class="uk-container uk-container-center">
		<div class="uk-block">
		<?php if($introtext) : ?>
			<h2 itemprop="headline" class="uk-h3">
				<?php echo $introtext; ?>
			</h2>
		<?php endif; ?>
		<?php if($fulltext) : ?>
			<?php echo $fulltext; ?>
		<?php endif; ?>
		</div>
		<?php if($this->portfolio) echo $this->loadTemplate('portfolio'); ?>
		<?php if($this->collections) echo $this->loadTemplate('collections'); ?>
		<?php if($this->collections || $this->instock) echo $this->loadTemplate('instock'); ?>
	</div>
</div>
</article>
