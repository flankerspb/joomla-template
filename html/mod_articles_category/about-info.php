<?php

defined('_JEXEC') or die;

$cats = $params->get('catid');

$url = JRoute::_(ContentHelperRoute::getCategoryRoute($cats[0]));

$title = JHtml::link($url, $list[0]->category_title);

?>
<div>
	<ul class="">
	<?php foreach ($list as $item) :
				
				static $i = 0;
				$i++;
				
				$link = JHtml::link($item->link, $item->title);
	?>
		<li>
			<?php echo $link; ?>
		</li>
		<?php endforeach;?>
	</ul>
</div>

