<?php

defined( '_JEXEC' ) or die();


JHtml::_('script', 'uikit/slideset.js', array('version' => 'auto', 'relative' => true));

$data = array(
		'autoplay: true',
		// 'default: 4',
		'small:2',
		'medium:4',
		'large:6',
		'animation:\'slide-horizontal\'', //fade|scale|slide-horizontal|slide-vertical|slide-top|slide-bottom
);

echo '<div class="uk-block"><div class="uk-container uk-container-center">';

if($showtitle)
{
	$title = $params->get('title_link') ? JHtml::link($params->get('title_link'), $params->get('title')) : $params->get('title');
	
	echo '<h2 class="uk-h1 uk-text-center">' . $title . '</h2>';
}

if($params->get('desc'))
{
	echo '<h2 class="uk-text-center uk-margin-large-top uk-margin-large-bottom fl-h uk-h2">' . $params->get('desc') . '</h2>';
}

echo '<div class="uk-margin uk-text-center" data-uk-slideset="{' . implode(',', $data) . '}"><div class="uk-slidenav-position uk-margin"><ul class="uk-slideset uk-grid uk-flex-center uk-grid-width-1-1 uk-grid-width-large-1-6 uk-grid-width-medium-1-4 uk-grid-width-small-1-2">';

foreach ($images as $image)
{
	if (file_exists($image->src))
	{
		$alt = $image->alt;
		$attribs = array();
		
		if ($image->title)
		{
			$attribs['title'] = $image->title;
		}
		else
		{
			$attribs['title'] = $image->alt;
		}
		
		if ($isPrefix)
		{
			switch ($addPrefix)
			{
				case 'alt':
					$alt = $prefix . ' ' . $alt;
					break;
				case 'title':
					$attribs['title'] = $prefix . ' ' . $attribs['title'];
					break;
				default:
					break;
			}
		}
		
		echo '<li>' . JHtml::image($image->src, $alt, $attribs) . '</li>';
	}
}

echo '</ul>';

echo '<a href="#" class="uk-slidenav uk-slidenav-previous" data-uk-slideset-item="previous"></a><a href="#" class="uk-slidenav uk-slidenav-next" data-uk-slideset-item="next"></a>';

echo '</div></div></div></div>';
