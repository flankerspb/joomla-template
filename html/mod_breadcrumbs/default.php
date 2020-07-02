<?php

// no direct access
defined('_JEXEC') or die;

$html = '';

$html .= '<nav class="uk-hidden-small"><ul itemscope itemtype="https://schema.org/BreadcrumbList" class="uk-breadcrumb">';

if(!$params->get('showLast', 1))
{
	array_pop($list);
}

$app     = JFactory::getApplication();

$pathway = $app->getPathway();

// if ($params->get('showHome', 1))
// {
	// $h = array_shift($list);
	// $html .= '<li class="fl-homepage"><a href="'.$h->link.'" title="'.$h->name.'"><i class="uk-icon-small uk-icon-home"></i></a></li>';
// }
// else
// {
	// $html .= '<li class="fl-homepage"><span></span></li>';
// }

$count = count($list);

// var_dump($list);

for($i = 0; $i < $count; $i ++)
{
	if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link)
	{
		continue;
	}
	
	// clean subtitle from breadcrumb
	if($pos = strpos($list[$i]->name, '||'))
	{
		$name = trim(substr($list[$i]->name, 0, $pos));
	}
	else
	{
		$name = $list[$i]->name;
	}
	
	$prop = ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"';
	
	$class = ($i < ($count-1)) ? '' : ' class="uk-active"';
	
	if (!empty($list[$i]->link))
	{
		$html .= '<li'.$prop.$class.'><a href="'.$list[$i]->link.'" itemprop="item"><span itemprop="name">'.$name.'</span></a><meta itemprop="position" content="'.($i+1).'" /></li>';
	}
	else
	{
		$html .= '<li'.$prop.$class.'><span>'.$name.'</span></li>';
	}
	
}

$html .= '</ul></nav>';

echo $html;
