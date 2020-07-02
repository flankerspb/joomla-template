<?php


defined('_JEXEC') or die;

JLoader::register('flContactHelper', __DIR__ . '/_helper.php');

$lang = $this->document->language;
$contact = $this->item;
$params = $this->params;

$layout = $params->get('layout', '_:default');

$tmp = explode(':', $layout)[1];

if($tmp != 'default')
{
	$this->setLayout(explode('.', $tmp)[0]);
	
	require __DIR__ . '/' . $tmp . '.php';
}