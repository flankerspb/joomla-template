<?php

defined('_JEXEC') or die;

if ($data->postcode)
{
	if($this->params->get('show_postcode'))
	{
		echo '<span class="contact-postcode" itemprop="postalCode">' . $data->postcode . '</span>';
	}
	else
	{
		echo '<meta itemprop="postalCode" content="' . htmlspecialchars($data->postcode) . '" />';
	}
}
if ($data->country)
{
	if($this->params->get('show_country'))
	{
		echo '<span class="contact-country" itemprop="addressCountry">' . $data->country . '</span>';
	}
	else
	{
		echo '<meta itemprop="addressCountry" content="' . htmlspecialchars($data->country) . '" />';
	}
}
if ($data->state)
{
	if($this->params->get('show_state'))
	{
		echo '<span class="contact-state" itemprop="addressRegion">' . $data->state . '</span>';
	}
	else
	{
		echo '<meta itemprop="addressRegion" content="' . htmlspecialchars($data->state) . '" />';
	}
}
if ($data->suburb)
{
	if($this->params->get('show_suburb'))
	{
		echo '<span class="contact-suburb" itemprop="addressLocality">' . $data->suburb . '</span>';
	}
	else
	{
		echo '<meta itemprop="addressLocality" content="' . htmlspecialchars($data->suburb) . '" />';
	}
}
if ($data->address)
{
	if($this->params->get('show_street_address'))
	{
		echo '<span class="contact-street" itemprop="streetAddress">' . $data->address . '</span>';
	}
	else
	{
		echo '<meta itemprop="streetAddress" content="' . htmlspecialchars($data->address) . '" />';
	}
}

if ($tparams->get('maps_latitude') && $tparams->get('maps_longitude'))
{
	echo '<div itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates">'
			. '<meta itemprop="latitude" content="' . htmlspecialchars($tparams->get('maps_latitude')) .'" />'
			. '<meta itemprop="longitude" content="' . htmlspecialchars($tparams->get('maps_longitude')) .'" />'
			. '</div>';
}
?>
	