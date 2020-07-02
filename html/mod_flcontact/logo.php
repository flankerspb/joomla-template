<?php
// no direct access
defined( '_JEXEC' ) or die();

$lang = strtolower(str_replace('-', '_',JFactory::getLanguage()->getTag()));

$image = $contact->image;
$name = $contact->params->$lang->name;

$image = JHtml::image($image, $name);
$link = JHtml::link(Juri::root(), $image);

echo '<div class="fl-logo">' . $link . '</div>';

