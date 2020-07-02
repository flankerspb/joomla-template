<?php

defined('_JEXEC') or die;

if($this->contact->image)
{
	if ($tparams->get('show_image'))
	{
		echo '<span>' . JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image logo','class' => 'uk-thumbnail')) . '</span>';
	}
	else
	{
		echo '<link itemprop="logo image" href="' . Juri::root() . $this->contact->image . '">';
	}
}

if($this->contact->telephone && $this->params->get('show_telephone'))
{
	echo '<span><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->telephone) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $this->contact->telephone) . '">' . $this->contact->telephone . '</span></a></span>';
}

if ($this->contact->mobile && $this->params->get('show_mobile'))
{
	echo '<span><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->mobile) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $this->contact->mobile) . '">' . $this->contact->mobile . '</span></a></span>';
}

if ($this->contact->fax && $this->params->get('show_fax'))
{
	echo '<span><a class="fl-icon fl-icon-fax" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->fax) . '"><span itemprop="faxNumber" content="' . preg_replace($phoneRegExp,"", $this->contact->fax) . '">' . $this->contact->fax . '</span></a></span>';
}

if ($this->contact->email_to && $this->params->get('show_email'))
{
	echo '<span>' . $this->contact->email_to . '</span>';
}
