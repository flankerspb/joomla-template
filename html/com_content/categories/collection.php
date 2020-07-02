<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2019 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$show_menu = 1;
$list_class = $show_menu ? 'uk-width-1-1 uk-width-medium-3-4 uk-width-large-4-5' : 'uk-width-1-1';
$parent_title = $this->parent ? $this->parent->getParent()->title : '';

$menu = JFactory::getApplication()->getMenu();
$active_menu = $menu->getActive();
$this->exclude_cats = $active_menu ? $menu->getParams($active_menu->tree[0])->get('exclude_cats', array()) : array();

$header = array();
$header['top'] = $parent_title;
$header['main'] = $this->escape($this->params->get('page_heading'));

?>
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<div class="fl-page-collections uk-block-large">
	<div class="uk-container uk-container-center">
		<div class="uk-grid">
			<?php if ($show_menu) : 
							$this->categories_menu_level = 0;
							$this->categories_menu = JCategories::getInstance('content')->get(12)->getChildren();
			?>
				<div class="uk-hidden-small uk-width-medium-1-4 uk-width-large-1-5">
					<nav class="uk-panel uk-block fl-panel-shadow">
						<?php echo $this->loadTemplate('menu'); ?>
					</nav>
				</div>
				<div class="uk-visible-small uk-width-1-1">
					<div class="uk-block uk-text-center">
						<div class="uk-button-dropdown" data-uk-dropdown="{pos:'bottom-center'}">
							<button class="uk-button uk-button-large uk-button-fill"><?php echo $this->escape($this->params->get('page_heading')); ?> <i class="uk-icon-caret-down"></i></button>
							<nav class="uk-dropdown uk-dropdown-small uk-dropdown-bottom uk-text-left">
								<ul class="uk-nav uk-nav-dropdown">
								<?php echo $this->loadTemplate('dropdown'); ?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="<?php echo $list_class; ?> uk-text-center">
			<?php if ($this->maxLevelcat != 0 && count($this->items[$this->parent->id]) > 0) : ?>
					<?php echo $this->loadTemplate('items'); ?>
				<?php else : ?>
					<div class="uk-text-center">
						<img src="/content/images/underconstract.png" alt="Раздел в разработке">
						<p class="uk-text-large uk-text-bold uk-text-muted">Раздел в разработке</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

