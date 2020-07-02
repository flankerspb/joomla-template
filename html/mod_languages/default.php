<?php

defined('_JEXEC') or die;

// $class = $moduleclass_sfx . ($params->get('inline', 1) ? 'lang-inline' : 'lang-block');
$class = ' class="fl-lang-switcher ' . $moduleclass_sfx . '"';
$dir = JFactory::getLanguage()->isRtl() ? ' dir="rtl"' : ' dir="ltr"';

$is_image = $params->get('image', 1);
$is_full_name = $params->get('full_name', 1);

$html = '<ul' . $class. $dir . '>';

foreach ($list as $lang)
{
	$tag = $lang->active ? '<li class="uk-active">' : '<li>';
	
	$title = $is_full_name ? $lang->title_native : strtoupper($lang->sef);
	
	$image = JHtml::image('mod_languages/' . $lang->image . '.gif', $lang->title, ['title' => $lang->title_native], true);
	
	$link = htmlspecialchars_decode(htmlspecialchars($lang->link, ENT_QUOTES, 'UTF-8'), ENT_NOQUOTES);
	
	$link = JHtml::link($link, $image);
	
	$html .=  $tag . $link . '</li>';
}

$html .= '</ul>';

echo $html;