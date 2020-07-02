<?php

defined('_JEXEC') or die;

$contact = $this->item;
$params = $this->params;
$name = $params->get('name', $contact->name);

$phoneRegExp = "~[^\d\+]~";

$types = $params->get('add_types', array());
array_unshift($types, $params->get('type', 'Organization'));

foreach($types as &$value)
{
	$value = 'https://schema.org/' . $value;
}


$images = array();

$images['show_gallery'] = 1;
$images['gallery'] = array();

for ($i = 0; $i < 10; $i++)
{
	$images['gallery'][$i]['alt'] = '';
	$images['gallery'][$i]['src'] = 'content/images/partners/sberbank.png';
}

?>
<div>
	<h1 class="uk-text-center"><?php echo $params->get('page_heading'); ?></h1>
	<article class="" itemscope itemtype="<?php echo implode(' ', $types); ?>">
		<meta itemprop="name" content="<?php echo $name; ?>" />
		
		<?php if ($params->get('legal_name')) : ?>
		<meta itemprop="legalName" content="<?php echo $params->get('legal_name'); ?>" />
		<?php endif; ?>
		
		<?php if ($contact->image) : ?>
		<link itemprop="logo image" href="<?php echo $contact->image; ?>">
		<?php endif; ?>
		
		<link itemprop="url" href="<?php echo Juri::base(); ?>">
		
		<?php if($params->get('founding_date')) : ?>
		<meta itemprop="foundingDate" content="<?php echo $params->get('founding_date'); ?>" />
		<?php endif; ?>
		
		<?php if($contact->telephone) : ?>
		<meta itemprop="telephone" content="<?php echo preg_replace($phoneRegExp, '', $contact->telephone); ?>" />
		<?php endif; ?>
		
		<?php if($contact->mobile) : ?>
		<meta itemprop="telephone" content="<?php echo preg_replace($phoneRegExp, '', $contact->mobile); ?>" />
		<?php endif; ?>
		
		<?php if($contact->fax) : ?>
		<meta itemprop="faxNumber" content="<?php echo preg_replace($phoneRegExp, '', $contact->fax); ?>" />
		<?php endif; ?>
		
		<?php if ($contact->misc && $params->get('show_misc')) : ?>
		<div class="description" itemprop="description">
			<?php echo $contact->misc; ?>
		</div>
		<?php endif; ?>
		
		<?php if (($this->params->get('address_check') > 0) && ($contact->address || $contact->suburb  || $contact->state || $contact->country || $contact->postcode)) : ?>
		
		<div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" hidden>
			<?php if ($contact->country) : ?>
			<meta itemprop="addressCountry" content="<?php echo $contact->country; ?>" />
			<?php endif; ?>
			<?php if ($contact->postcode) : ?>
			<meta itemprop="postalCode" content="<?php echo $contact->postcode; ?>" />
			<?php endif; ?>
			<?php if ($contact->state) : ?>
			<meta itemprop="addressRegion" content="<?php echo $contact->state; ?>" />
			<?php endif; ?>
			<?php if ($contact->suburb) : ?>
			<meta itemprop="addressLocality" content="<?php echo $contact->suburb; ?>" />
			<?php endif; ?>
			<?php if ($contact->address) : ?>
			<meta itemprop="streetAddress" content="<?php echo $contact->address; ?>" />
			<?php endif; ?>
		</div>
		<?php endif; ?>
		
		<?php if (is_array($params->get('area_served')))
			{
				foreach($params->get('area_served') as $value)
				{
					echo '<div itemprop="areaServed" itemscope itemtype="https://schema.org/' . $value['type'] .'" hidden><meta itemprop="name" content="' . $value['value'] .'" /></div>';
				}
			}
		?>
	</article>
</div>