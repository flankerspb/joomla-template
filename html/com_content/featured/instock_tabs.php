<?php


defined('_JEXEC') or die;

$show_parent = 0;

$menu = JFactory::getApplication()->getMenu();
$active = $menu->getActive();
$parent_id = $active->tree[0];

$items = $menu->getItems('parent_id', $parent_id);

if($show_parent)
{
	array_unshift($items, $menu->getItem($parent_id));
}

$tabs = '';
$dropdown = '';
$dropdownTitle = '';


foreach ($items as $item)
{
	// $menu->getParams($item->id);
	
	$title = $item->note ? $item->note : $item->title;
	
	$link_attribs = array();
	$link_attribs['title'] = $item->title;
	
	$link = JHtml::link('index.php?Itemid=' . $item->id, $title, $link_attribs);
	
	if($item->id == $active->id)
	{
		$tabItem = '<li class="uk-active uk-hidden-small">';
		$dropdownItem = '<li class="uk-active">';
		$dropdownTitle = $title;
	}
	else
	{
		$tabItem = '<li class="uk-hidden-small">';
		$dropdownItem = '<li>';
	}
	
	$tabs .= $tabItem . $link . '</li>';
	$dropdown .= $dropdownItem . $link . '</li>';
}

?>
<nav class="uk-tab-center" id="menu-carpets">
	<ul class="uk-tab">
		<?php echo $tabs; ?>
		<li class="uk-tab-responsive uk-active uk-visible-small" data-uk-dropdown="{pos:'bottom-center'}">
			<a><?php echo $dropdownTitle; ?></a>
			<div class="uk-dropdown uk-dropdown-small">
				<ul class="uk-nav uk-nav-dropdown">
					<?php echo $dropdown; ?>
				</ul>
			<div></div>
			</div>
		</li>
	</ul>
</nav>
