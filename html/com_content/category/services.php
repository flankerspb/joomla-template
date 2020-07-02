<?php

defined('_JEXEC') or die;



// $this->items = null;
// $this->menu = null;
// $this->category = null;
// $this->state = null;
// $this->pagination = null;
// $this->document = null;
// $this->parent = null;
// $this->params = null;
// $this->_models = null;


// var_dump($this->params);
// var_dump($this->items);
// var_dump($this->category);
// var_dump($this->menu);
// var_dump($this->pathway);
// var_dump($this->parent);
// var_dump($this->state);
// var_dump($this->pagination);
// var_dump($this->document);
// var_dump($this->_models);

// foreach($this as $k =>$asd)
// {
	// var_dump($k);
// }


// var_dump($this);


// JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');



$params    = $this->params;
$category  = $this->get('category');
$extension = $category->extension;

$this->subtemplatename = 'articles';

$cat_uri = JRoute::_(ContentHelperRoute::getCategoryRoute($this->category->id));

?>
<div class="" itemscope itemtype="http://schema.org/OfferCatalog">

<?php if($params->get('show_page_heading')) : ?>
	<h1 class="uk-text-center" itemprop="name"><?php echo $this->escape($params->get('page_heading')); ?></h1>
<?php elseif($params->get('show_category_title', 1)) : ?>
	<h1 class="uk-text-center"><?php echo $category->title; ?></h1>
<?php else : ?>
	<meta content="<?php echo $category->title; ?>">
<?php endif; ?>

<?php if ($category->description) : ?>
	<div class="uk-margin-large-bottom uk-text-large uk-text-danger" itemprop="description">
		<?php echo $category->description; ?>
	</div>
<?php endif; ?>
	
	<link itemprop="url" href="<?php echo $cat_uri; ?>">
	<ul class="uk-grid uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-3" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin>
	<?php foreach ($this->items as $item) :
				
				static $i = 0;
				$i++;
				
				$images = json_decode($item->images);
				
				if($images->image_intro && file_exists(JPATH_ROOT .'/'. $images->image_intro))
				{
					$image = $images->image_intro;
					$alt = $item->title;
				}
				else
				{
					$image ='content/source/billboard.png';
					$alt = JText::_('FL_NO_IMAGE');
				}
				
				$image_attribs = array();
				$image_attribs['class'] = 'fl-image-teaser';
				$image_attribs['itemprop'] = 'image';
				
				$image = JHtml::image($image, $alt, $image_attribs);
				
				$link_attribs = array();
				$link_attribs['class'] = 'uk-position-cover';
				$link_attribs['itemprop'] = 'url';
				
				$uri = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language));

				$link = JHtml::link($uri, '<span class="uk-hidden">' . $item->title . '</span>', $link_attribs);
				
				
				/* <meta itemprop="position" content="<?php echo $i; ?>"> */
	?>
		<li itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
			<div class="uk-panel uk-panel-box uk-panel-box-primary uk-text-center tm-panel-hover" itemprop="itemOffered" itemscope itemtype="https://schema.org/Service">
				<?php echo $image; ?>
				<h3 class="uk-panel-title" itemprop="name"><?php echo $item->title; ?></h3>
				<?php echo $link; ?>
			</div>
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
