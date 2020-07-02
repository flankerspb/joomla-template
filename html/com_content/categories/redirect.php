<?php

defined('_JEXEC') or die;

if($this->params->get('redirect'))
{
	$uri = JRoute::_('index.php?Itemid=' . $this->params->get('redirect'));
}
else if($this->params->get('aliasoptions'))
{
	$uri = JRoute::_('index.php?Itemid=' . $this->params->get('aliasoptions'));
}
else
{
	$uri = Juri::root();
}

header("HTTP/1.1 301 Moved Permanently");
header('Location: ' . $uri);
