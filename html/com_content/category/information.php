<?php

defined('_JEXEC') or die;

$params    = $this->params;
$category  = $this->get('category');
$extension = $category->extension;

$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select('name, image, webpage')->from('#__contact_details')->where('id = 1');
$db->setQuery($query);
$author = $db->loadObject();

$this->subtemplatename = 'articles';

$cat_uri = JRoute::_(ContentHelperRoute::getCategoryRoute($this->category->id));

?>
<article class="" itemscope itemtype="https://schema.org/Article">

<?php if($params->get('show_page_heading')) : ?>
	<h1 class="uk-text-center" itemprop="name headline"><?php echo $this->escape($params->get('page_heading')); ?></h1>
<?php elseif($params->get('show_category_title', 1)) : ?>
	<h1 itemprop="name headline" class="uk-text-center"><?php echo $category->title; ?></h1>
<?php else : ?>
	<meta itemprop="name headline" content="<?php echo $category->title; ?>">
<?php endif; ?>

<?php if ($category->description) : ?>
	<div class="uk-margin-large-bottom uk-text-large" itemprop="description articleBody text">
		<?php echo $category->description; ?>
	</div>
<?php endif; ?>
	
	<link itemprop="url mainEntityOfPage" href="<?php echo $cat_uri; ?>">
	
	<meta itemprop="dateCreated" content="<?php echo substr($category->created_time, 0, 10); ?>">
	<meta itemprop="datePublished" content="<?php echo substr($category->created_time, 0, 10); ?>">
	<meta itemprop="dateModified" content="<?php echo substr($category->modified_time, 0, 10); ?>">
	
	<meta itemprop="version" content="<?php echo $category->version; ?>">
	
	<?php if ($author) : ?>
	<span itemprop="author publisher" itemscope itemtype="https://schema.org/Organization" hidden>
		<meta itemprop="name" content="<?php echo $author->name; ?>">
		<link itemprop="url" href="<?php echo $author->webpage ? $author->webpage: Juri::root(); ?>">
		<link itemprop="logo" href="<?php echo $author->image; ?>">
	</span>
	<?php endif; ?>
	
	<?php if($images['icon']) : ?>
	<link itemprop="image thumbnailUrl" href="<?php echo $images['icon']; ?>">
	<?php endif; ?>
	
	<ul class="">
	<?php foreach ($this->items as $item) :
				
				static $i = 0;
				$i++;
				
				$uri = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));

				$link = JHtml::link($uri, $item->title, 'itemprop="url mainEntityOfPage"');
	?>
		<li itemprop="hasPart" itemscope itemtype="https://schema.org/CreativeWork">
			<h3 class="uk-h4" itemprop="name"><?php echo $link; ?></h3>
		</li>
		<?php endforeach;?>
	</ul>
	
	<?php // Add pagination links ?>
	<?php if(!empty($this->items)) : ?>
		<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
			<div class="pagination">

				<?php if ($this->params->def('show_pagination_results', 1)) : ?>
					<p class="counter pull-right">
						<?php echo $this->pagination->getPagesCounter(); ?>
					</p>
				<?php endif; ?>

				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if ($this->maxLevel != 0 && $this->get('children')) : ?>
		<div class="cat-children">
			<?php if ($params->get('show_category_heading_title_text', 1) == 1) : ?>
				<h3>
					<?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?>
				</h3>
			<?php endif; ?>
			<?php echo $this->loadTemplate('children'); ?>
		</div>
	<?php endif; ?>
	
</div>
