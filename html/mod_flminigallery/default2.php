<?php
defined( '_JEXEC' ) or die();
// var_dump($params);
if($showtitle)
{
	$title = $params->get('title');
	$tag = $params->get('header_tag', 'h3');
	$class = $params->get('header_class');
	$title =  "<{$tag} class='uk-text-center {$class}' id='clients'>{$title}</{$tag}>";
}

$imgAttribs = array();
$urlAttribs = array();

$urlAttribs['target'] = "_blank";

$prefix = $params->get('prefix');
$addPrefix = $params->get('add_prefix');
$isPrefix = $params->get('add_prefix') && $prefix;

$buffer = [];

foreach ($images as $image)
{
	if(file_exists($image->src))
	{
		$alt = $image->alt;
		$attribs = $imgAttribs;
		
		if ($image->title)
		{
			// $attribs['title'] = $image->title;
		}
		else
		{
			// $attribs['title'] = $image->alt;
		}
		
		if ($isPrefix)
		{
			switch ($addPrefix)
			{
				case 'alt':
					$alt = $prefix . ' ' . $alt;
					break;
				case 'title':
					// $attribs['title'] = $prefix . ' ' . $attribs['title'];
					break;
				default:
					break;
			}
		}
		
		if (pathinfo($image->src, PATHINFO_EXTENSION) == 'svg')
		{
			$width = $params->get('width') ? $params->get('width') . 'px' : '100%';
			
			$svg = simplexml_load_file($image->src);
			$svg->addAttribute('role', 'img');
			$svg->addAttribute('aria-labelledby', 'title');
			$svg->addAttribute('width', $width);
			$svg->addChild('title', $attribs['title'])->addAttribute('id', 'title');
			
			$img = $svg->asXML();
		}
		else
		{
			$img = JHtml::image($image->src, $alt, $attribs);
		}
		
		$html = $image->url ? JHtml::link($image->url, $img, $urlAttribs) : $img;
		$buffer[] = '<div>' . $html . '</div>';
	}
}

?>
<div class="uk-block">
	<div class="uk-container uk-container-center">
		<?php echo $title; ?>
		<div class="uk-grid uk-grid-width-1-3 uk-grid-width-small-1-4 uk-grid-width-medium-1-5 fl-minigaggery uk-flex uk-flex-center" data-uk-grid-margin data-uk-grid-match="{target:\'.uk-panel\', row: false}">
		<?php echo implode('', $buffer); ?>
		</div>
	</div>
</div>