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

// var_dump($this->params);

$this->subtemplatename = 'articles';

$cat_uri = JRoute::_(ContentHelperRoute::getCategoryRoute($this->category->id));

$description = explode('<hr data-split/>', $category->description);

?>
<article itemscope itemtype="http://schema.org/Service">
	<h1 itemprop="name" class="uk-text-center"><?php echo $this->escape($params->get('page_heading')); ?></h1>
	<link itemprop="url" href="<?php echo Juri::current(); ?>">
	
	<div itemprop="areaServed" itemscope itemtype="https://schema.org/City" hidden><meta itemprop="name" content="Санкт-Петербург" /></div>
	<div itemprop="areaServed" itemscope itemtype="https://schema.org/State" hidden><meta itemprop="name" content="Ленинградская область" /></div>
	
	<?php if($description[0]) : ?>
	<div itemprop="description">
		<?php echo $description[0]; ?>
	</div>
	<?php endif; ?>
	
	<?php if(count($this->items)) : ?>
	<div class="uk-margin-top" itemprop="hasOfferCatalog" itemscope itemtype="http://schema.org/OfferCatalog">
		<meta itemprop="name" content="<?php echo $category->title; ?>">
		<link itemprop="url" href="<?php echo $cat_uri; ?>">
		<ul class="uk-list uk-list-line">
		<?php foreach ($this->items as $item) :
					
					static $i = 0;
					$i++;
					
					$images = json_decode($item->images);
					
					if($images->image_intro && file_exists(JPATH_ROOT .'/'. $images->image_intro))
					{
						$image = $images->image_intro;
						$alt = $item->title;
					}
					else if(file_exists(JPATH_ROOT .'/content/images/print/'. $item->alias . '.png'))
					{
						$image = 'content/images/print/'. $item->alias . '.png';
						$alt = $item->title;
					}
					else
					{
						$image = 'content/images/print/_noimage.png';
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
		?>
			<li class="fl-list-item uk-panel" itemprop="itemListElement" itemscope itemtype="https://schema.org/Offer">
				<div class="uk-grid uk-grid-small" itemprop="itemOffered" itemscope itemtype="http://schema.org/Service">
					<div class="uk-width-small-1-10 uk-hidden-phone fl-block-image">
						<?php echo $image; ?>
					</div>
					<div class="uk-width-1-1 uk-width-small-9-10 fl-block-content">
						<h3 class="uk-panel-title tm-title-link" itemprop="name"><?php echo $item->title; ?></h3>
						<meta itemprop="category" content="<?php echo $category->path; ?>">
						<div class="">
						<?php echo $item->introtext; ?>
						</div>
					</div>
				</div>
				<?php echo $link; ?>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<?php endif; ?>
	
	<?php if($description[1]) : ?>
	<div class="uk-margin-top">
		<?php echo $description[1]; ?>
	</div>
	<?php endif; ?>
	
</article>
