<?php

defined('_JEXEC') or die;


$input = JFactory::getApplication()->input->getArray();

$html = '<nav><ul class="uk-subnav uk-subnav-line">';


$html .= '<li data-uk-dropdown>';
$html .= '<a href="#" class="fl-toolbar-info"><span>Заказчику</span><i class="uk-icon-angle-down uk-margin-small-left"></i></a>';

$html .= '<div class="uk-dropdown uk-dropdown-small">';
$html .= '<ul class="uk-nav uk-nav-dropdown">';

foreach($list as $item)
{
	if($input['option'] == 'com_content' && $input['view'] == 'article' && $input['id'] == $item->id)
	{
		$html .= '<li class="uk-active">';
	}
	else
	{
		$html .= '<li>';
	}
	$link_attribs = array();
	// $link_attribs['class'] = 'uk-position-cover';
	// $link_attribs['itemprop'] = 'url';
	
	$html .= JHtml::link($item->link, $item->title, $link_attribs);
	
	$html .= '</li>';
}


$html .= '</ul>';
$html .= '</div>';
$html .= '</ul></nav>';

echo $html;
