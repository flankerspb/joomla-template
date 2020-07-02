<?php


defined('_JEXEC') or die;

$menu_class = $this->categories_menu_level ? 'uk-nav-sub' : 'uk-nav fl-nav-side';

if(!$this->sidebar_menu)
	$this->sidebar_menu = $this->categories_menu;

?>
<ul class="<?php echo $menu_class; ?>">
<?php 
foreach ($this->sidebar_menu as $item)
{
	if(in_array($item->id, $this->exclude_cats))
	{
		continue;
	}
	
	$title = $item->note ? $item->note : $item->title;
	
	$url = JRoute::_(ContentHelperRoute::getCategoryRoute($item->id, $item->language));
	
	$link_attribs = array();
	
	$class = array();
	
	if(!$this->categories_menu_level)
	{
		$link_attribs['class'] = 'uk-text-bold';
	}
	
	if($item->id == $this->parent->id)
	{
		$class[] = 'uk-active';
	}
	
	$children = '';
	
	if($item->hasChildren())
	{
		$class[] = 'uk-parent';
		
		$this->categories_menu_level++;
		$this->sidebar_menu = $item->getChildren();
		$children = $this->loadTemplate('menu');
		$this->categories_menu_level--;
	}
	
	$link = JHtml::link($url, '<span>' . $title . '</span>', $link_attribs);
	
	$tag = $class ? '<li class="' . implode(' ', $class) . '">' : '<li>';
	
	echo $tag . $link . $children . '</li>';
}
?>
</ul>
