<?php

defined('_JEXEC') or die();

$active = JRequest::getInt('category_id');

$html = '<nav class="">';

foreach($cats[0] as $key => $value)
{
	if($value->active)
	{
		$html .= ($key == $active) ? '<h3 class="uk-active uk-panel-title">' : '<h3 class="uk-panel-title">';
		
		$html .= JHtml::link($value->link, $value->name, 'class="fl-link"');
		
		$html .= '</h3>';
		
		if($cats[$key])
		{
			$html .= '<ul class="uk-nav uk-nav-side">';
			
			foreach($cats[$key] as $k => $v)
			{
				$html .= ($k == $active) ? '<li class="uk-active">' : '<li>';
				
				$html .= JHtml::link($v->link, $v->name, 'class="fl-link"');
				
				$html .= '</li>';
			}
			
			$html .= '</ul>';
		}
		break;
	}
}

$html .= '</nav>';

echo $html;
