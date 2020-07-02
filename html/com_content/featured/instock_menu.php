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

$html = '';

foreach ($items as $item)
{
	$title = $item->note ? $item->note : $item->title;
	
	$link_attribs = array();
	$link_attribs['title'] = $item->title;
	
	$link = JHtml::link('index.php?Itemid=' . $item->id, $title, $link_attribs);
	
	if($item->id == $active->id)
	{
		$tabItem = '<li class="uk-active">';
	}
	else
	{
		$tabItem = '<li>';
	}
	
	$html .= $tabItem . $link . '</li>';
}

?>
<nav class="uk-panel">
	<ul class="uk-nav fl-nav-collections">
		<?php echo $html; ?>
	</ul>
</nav>
