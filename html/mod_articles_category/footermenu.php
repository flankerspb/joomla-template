<?php

defined('_JEXEC') or die;


$input = JFactory::getApplication()->input->getArray();

$html = '<nav class="fl-footer-info-menu"><ul class="uk-subnav uk-subnav-line">';

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

$html .= '</ul></nav>';

echo $html;
