<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2018 Vitaliy Moskalyuk. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// jimport('joomla.html.html.bootstrap');
$lang = $this->document->language;

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->item->params;

$phoneRegExp = "~[^\d\+]~";

if($tparams->get('name'))
{
	$name = $tparams->get('name');
}
else
{
	$name = $this->contact->name;
}

$header = array();
$header['main'] = $this->escape($tparams->get('page_heading'));

?>
<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
<article class="fl-article-contact" itemscope itemtype="https://schema.org/Organization">
<div class="fl-collection-article uk-block-large">
	<div class="uk-container uk-container-center">
		<div class="uk-grid">
			<div class="uk-width-1-1 uk-width-large-1-2">
				<div class="uk-panel uk-block uk-text-center">
					<h2 class="uk-h2 fl-margin-remove"  itemprop="name"><?php echo $name; ?></h2>
					
					<?php if ($tparams->get('legal_name')) : ?>
					<meta itemprop="legalName" content="<?php echo $tparams->get('legal_name'); ?>" />
					<?php endif; ?>
					
					<?php if (is_array($tparams->get('alter_names')))
								{
									foreach($tparams->get('alter_names') as $value)
									{
										echo '<meta itemprop="alternateName" content="' . $value['name'] .'"/>';
									}
								}
					?>
					
					<?php if ($tparams->get('founding_date')) : ?>
					<meta itemprop="foundingDate" content="<?php echo $tparams->get('founding_date'); ?>" />
					<?php endif; ?>
					
					<link itemprop="url" href="<?php echo Juri::base(); ?>">
					<link itemprop="mainEntityOfPage" href="<?php echo Juri::current(); ?>">
					
					<?php
					if ($this->contact->image)
					{
						if ($tparams->get('show_image'))
						{
							echo '<div class="uk-text-center">' . JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image logo','class' => 'uk-thumbnail')) . '</div>';
						}
						else
						{
							echo '<link itemprop="logo image" href="' . Juri::root() . $this->contact->image . '">';
						}
					}
					?>
					
					<?php 
					if ($this->contact->telephone && $this->params->get('show_telephone'))
					{
						echo '<div class="uk-margin-top fl-phone uk-text-large"><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->telephone) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $this->contact->telephone) . '">' . str_replace('+7','',$this->contact->telephone) . '</span></a></div>';
					}
					
					if ($this->contact->mobile && $this->params->get('show_mobile'))
					{
						echo '<div class="uk-margin-top fl-phone uk-text-large"><a class="fl-icon fl-icon-phone" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->mobile) . '"><span itemprop="telephone" content="' . preg_replace($phoneRegExp,"", $this->contact->mobile) . '">' . str_replace('+7','',$this->contact->mobile) . '</span></a></div>';
					}
					
					if ($this->contact->fax && $this->params->get('show_fax'))
					{
						echo '<div class="uk-margin-top fl-phone uk-text-large"><a class="fl-icon fl-icon-fax" href="tel:' . preg_replace($phoneRegExp,"", $this->contact->fax) . '"><span itemprop="faxNumber" content="' . preg_replace($phoneRegExp,"", $this->contact->fax) . '">' . str_replace('+7','',$this->contact->fax) . '</span></a></div>';
					}
					
					if ($this->contact->email_to && $this->params->get('show_email'))
					{
						echo '<div class="uk-margin-top fl-email uk-text-large">' . $this->contact->email_to . '</div>';
					}
					?>
					
					<?php if (($this->params->get('address_check') > 0) &&
					($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
						
						<div class="contact-address uk-margin-top uk-text-large"  itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
							<span class="fl-address fl-icon fl-icon-mapmarker"><?php
							if ($this->contact->country)
							{
								if($this->params->get('show_country'))
								{
									echo '<span class="contact-country" itemprop="addressCountry">' . $this->contact->country . '</span>';
								}
								else
								{
									echo '<meta itemprop="addressCountry" content="' . $this->contact->country . '" />';
								}
							}
							if ($this->contact->postcode)
							{
								if($this->params->get('show_postcode'))
								{
									echo '<span class="contact-postcode" itemprop="postalCode">' . $this->contact->postcode . '</span>';
								}
								else
								{
									echo '<meta itemprop="postalCode" content="' . $this->contact->postcode . '" />';
								}
							}
							if ($this->contact->state)
							{
								if($this->params->get('show_state'))
								{
									echo '<span class="contact-state" itemprop="addressRegion">' . $this->contact->state . '</span>';
								}
								else
								{
									echo '<meta itemprop="addressRegion" content="' . $this->contact->state . '" />';
								}
							}
							if ($this->contact->suburb)
							{
								if($this->params->get('show_suburb'))
								{
									echo '<span class="contact-suburb" itemprop="addressLocality">' . $this->contact->suburb . '</span>';
								}
								else
								{
									echo '<meta itemprop="addressLocality" content="' . $this->contact->suburb . '" />';
								}
							}
							if ($this->contact->address)
							{
								if($this->params->get('show_street_address'))
								{
									echo '<span class="contact-street" itemprop="streetAddress">' . $this->contact->address . '</span>';
								}
								else
								{
									echo '<meta itemprop="streetAddress" content="' . $this->contact->address . '" />';
								}
							}
							?></span>
						</div>
						
						<?php if ($tparams->get('maps_latitude') && $tparams->get('maps_longitude')) : ?>
						<div itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates">
							<meta itemprop="latitude" content="<?php echo $tparams->get('maps_latitude'); ?>" />
							<meta itemprop="longitude" content="<?php echo $tparams->get('maps_longitude'); ?>" />
						</div>
						<?php endif; ?>
						
					<?php endif; ?>
					
					<?php if ($tparams->get('openhours_text')) : ?>
					<div class="uk-margin-top fl-inline-block">
						<hr>
						<span class="fl-openhours fl-icon fl-icon-openhours"><?php echo $tparams->get('openhours_text'); ?></span>
					</div>
					<?php endif; ?>
					
					<?php if (is_array($tparams->get('openhours')))
								{
									foreach($tparams->get('openhours') as $value)
									{
										$days = implode(',',$value['days']);
										$open = sprintf('%02s', $value['open_hour']) . ':' . sprintf('%02s', $value['open_min']);
										$close = sprintf('%02s', $value['close_hour']) . ':' . sprintf('%02s', $value['close_min']);
										echo '<meta itemprop="openingHours" content="' .$days . ' ' . $open . '-' . $close .'"/>';
									}
								}
					?>
					
					<?php if ($tparams->get('show_links') && $tparams->get('social')['show_links'] && is_array($tparams->get('social')['links'])) : ?>
						<?php echo $this->loadTemplate('links'); ?>
					<?php endif; ?>
					
				</div>
			</div>
			<div class="uk-width-1-1 uk-width-large-1-2">
				<?php if ($tparams->get('use_maps') == 'yamaps'): 
				
					$lang_tag = str_replace('-', '_', $lang);
			
					switch ($lang_tag)
					{
						case 'ru_ru':
						case 'en_us':
						case 'ru_ua':
						case 'uk_ua':
						case 'tr_tr':
							break;
						default:
							$lang_tag = 'en_ru';
							break;
					}
					$api_key = $tparams->get('yamaps_apikey', '');
					$api_key = $api_key ? $api_key : '';
				
				
				?>
				<div class="uk-panel">
					<div id="map_canvas" class="fl-map fl-thumbnail"
						data-lat="<?php echo $tparams->get('maps_latitude'); ?>"
						data-lng="<?php echo $tparams->get('maps_longitude'); ?>"
						data-zoom="<?php echo $tparams->get('maps_zoom'); ?>"
						data-type="<?php echo $tparams->get('yamaps_type', 'map'); ?>"
					></div>
					<script src="https://api-maps.yandex.ru/2.1/?lang=<?php echo $lang_tag, $api_key; ?>"></script>
					<script>
						ymaps.ready(function(){
							var data = document.getElementById('map_canvas').dataset;
							var coords = [data.lat, data.lng];
							var map = new ymaps.Map('map_canvas', {
								center: coords,
								type: 'yandex#' + data.type,
								zoom: data.zoom,
								controls: ['geolocationControl']
							});
							
							map.behaviors.disable(['scrollZoom','dblClickZoom']);
							
							var zoomControl = new ymaps.control.ZoomControl({
								options: {
									size: "small"
								}
							});
							map.controls.add(zoomControl);
							
							var fullscreenControl = new ymaps.control.FullscreenControl();
							map.controls.add(fullscreenControl);
							fullscreenControl.events.add('fullscreenenter', function() {
								document.documentElement.style.overflow = 'unset';
							}, this);
							fullscreenControl.events.add('fullscreenexit', function() {
								document.documentElement.style.overflow = null;
							}, this);
							
							var placemark = new ymaps.Placemark(coords, {}, {
								preset: 'islands#redDotIcon',
								hasBalloon: false
							});
							map.geoObjects.add(placemark);
					});
					</script>
				</div>
				<?php endif; ?>
			</div>
			
			<?php 
			$props = $tparams->get('props');
			if ($props['show'] && is_array($props['data'])) : ?>
				<div class="uk-width-1-1">
				<?php echo $this->loadTemplate('props');?>
				</div>
			<?php endif; ?>
			
			</div>
		</div>
	</div>
</div>
</article>