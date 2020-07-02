<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$show_menu = 1;

$list_class = $show_menu ? 'uk-width-1-1 uk-width-medium-4-5 uk-width-large-5-6' : 'uk-width-1-1';



$menu = JFactory::getApplication()->getMenu();
$active = $menu->getActive();
$parent = $menu->getItem($active->tree[0]);

$header = array();
$header['top'] = $parent->title;
$header['main'] = $active->title;


?>
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>

<div class="fl-page-collection uk-block-large">
	<div class="uk-container uk-container-center fl-collection-list">
		<div class="uk-grid">
			<?php if ($show_menu) :
							$this->categories_menu_level = 0;
							$this->categories_menu = JCategories::getInstance('content')->get(12)->getChildren();
			?>
				<div class="uk-hidden-small uk-width-medium-1-5 uk-width-large-1-6">
					<nav class="uk-panel">
						<?php echo $this->loadTemplate('menu'); ?>
					</nav>
				</div>
			<?php endif; ?>
			<div class="<?php echo $list_class; ?> uk-text-center">
				<div>
				<?php if($this->lead_items) : ?>
					<div class="uk-flex uk-flex-center uk-grid uk-grid-width-1-2 uk-grid-width-small-1-4 uk-grid-width-large-1-6" data-uk-grid-match="{row: false, target:'h3'}" data-uk-grid-margin itemscope itemtype="https://schema.org/ItemList">
						<meta itemprop="name" content="<?php echo $this->category->title; ?>">
						<link itemprop="url" href="<?php echo JUri::current(); ?>">
						<?php echo $this->loadTemplate('items'); ?>
					</div>
					<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->pagesTotal > 1)) {echo $this->pagination->getPagesLinks();} ?>
				<?php else : ?>
					<div class="uk-text-center">
						<img src="/images/wait.png" alt="Ожидается поставка" style="opacity: 0.75;">
						<p class="uk-text-large uk-text-bold uk-contrast" style="opacity: 0.75;">Ожидается поставка</p>
					</div>
				<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>
</div>