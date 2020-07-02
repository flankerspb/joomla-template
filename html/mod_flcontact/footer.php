<?php
// no direct access
defined( '_JEXEC' ) or die();

$year = substr($contact->params->founding_date, 0, 4);
$now = date('Y');
$year = ($year || $year == $now) ? $year : $year . '-' . $now;

$link = JHtml::link(Juri::root(), $contact->name)

?>
<div class="uk-panel tm-footer-copyright">
	<div class="uk-flex uk-flex-middle uk-flex-space-between">
		<div class="fl-copyright"><span>&copy; </span><span><?php echo $now; ?></span> <span><?php echo $link; ?></span></div>
		<div class="fl-totop"><a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a></div>
	</div>
</div>

