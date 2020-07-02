<?php

defined('_JEXEC') or die;

$phoneRegExp = "~[^\d\+]~";

$params = $this->params;
$contact = $this->item;

?>
<div class="contact-address uk-margin-small-top"  itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
	<?php
	if($contact->country)
	{
		echo flContactHelper::address($contact->country, 'country', $params->get('show_country'));
	}
	if($contact->postcode)
	{
		echo flContactHelper::address($contact->postcode, 'postcode', $params->get('show_postcode'));
	}
	if($contact->state)
	{
		echo flContactHelper::address($contact->state, 'state', $params->get('show_state'));
	}
	if($contact->suburb)
	{
		echo flContactHelper::address($contact->suburb, 'suburb', $params->get('show_suburb'));
	}
	if($contact->address)
	{
		echo flContactHelper::address($contact->address, 'address', $params->get('show_street_address'));
	}
	?>
</div>
<?php
if($contact->telephone && $params->get('show_telephone'))
{
	echo '<div class="uk-margin-small-top fl-phone"><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $contact->telephone) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $contact->telephone) . '">' . str_replace('+7','',$contact->telephone) . '</span></a></div>';
}

if($contact->mobile && $params->get('show_mobile'))
{
	echo '<div class="uk-margin-small-top fl-phone"><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $contact->mobile) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $contact->mobile) . '">' . str_replace('+7','',$contact->mobile) . '</span></a></div>';
}

if($contact->fax && $params->get('show_fax'))
{
	echo '<div class="uk-margin-small-top fl-phone"><a class="fl-icon fl-icon-fax" href="tel:' . preg_replace($phoneRegExp,"", $contact->fax) . '"><span itemprop="faxNumber" content="' . preg_replace($phoneRegExp,"", $contact->fax) . '">' . str_replace('+7','',$contact->fax) . '</span></a></div>';
}

if($contact->email_to && $params->get('show_email'))
{
	echo '<div class="uk-margin-small-top fl-email">' . $contact->email_to . '</div>';
}
?>