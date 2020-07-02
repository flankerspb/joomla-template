<?php
// no direct access
defined( '_JEXEC' ) or die();
// var_dump($contact->params);

$headers = $params->get('headers');
$text = $params->get('text');

$html = '';
$links = $contact->params->social->links;
$links_class = ' uk-icon-button uk-margin-left';

foreach($links as $link)
{
	$attribs = array();
	$title = '<span class="uk-hidden">' . $link->title . '</span>';
	$attribs['title'] = $link->title;
	$attribs['target'] = $link->target;
	$attribs['class'] = $link->class . $links_class;
	
	$html .= JHtml::link($link->url, $title, $attribs);
}

?>
<div class="uk-panel uk-text-center">
	<div class="uk-grid uk-grid-margin uk-flex uk-flex-center uk-flex-middle uk-margin-top-remove" data-uk-grid-margin>
		<div class="uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-4">
			<div class="uk-panel">
				<h2 class="uk-h3"><?php echo $headers->h1; ?></h2>
			</div>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
			<div class="uk-panel">
				<p><?php echo $text->t1; ?></p>
			</div>
		</div>
		<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4">
			<div class="uk-panel">
				<?php echo $html; ?>
			</div>
		</div>
	</div>
</div>
