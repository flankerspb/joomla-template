<?php

defined('_JEXEC') or die;

$params = $this->params;
$api_key = $params->get('yamaps_apikey', '');

$lang = str_replace('-', '_', $this->document->language);
switch ($lang)
{
	case 'ru_ru':
	case 'en_us':
	case 'ru_ua':
	case 'uk_ua':
	case 'tr_tr':
		break;
	default:
		$lang = 'en_ru';
		break;
}

?>
<div id="map_canvas" class="fl-map fl-thumbnail"
	data-lat="<?php echo $params->get('maps_latitude'); ?>"
	data-lng="<?php echo $params->get('maps_longitude'); ?>"
	data-zoom="<?php echo $params->get('maps_zoom'); ?>"
	data-type="<?php echo $params->get('yamaps_type', 'map'); ?>"
></div>
<script src="https://api-maps.yandex.ru/2.1/?lang=<?php echo $lang, $api_key; ?>"></script>
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
