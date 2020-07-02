<?php

defined('_JEXEC') or die;


$name = $params->get('name', $contact->name);

$types = $params->get('add_types', array());

array_unshift($types, $params->get('type', 'Organization'));

foreach($types as &$value)
{
	$value = 'https://schema.org/' . $value;
}

?>
<div>
	<h1 class=""><?php echo $params->get('page_heading'); ?></h1>
	
	<article class="uk-grid uk-grid-match" itemscope itemtype="<?php echo implode(' ', $types); ?>">
	
		<div class="uk-width-1-1 uk-width-large-1-2">
			<div class="uk-panel">
				
				<h2 class="uk-h3 fl-margin-remove"  itemprop="name"><?php echo $name; ?></h2>
				
				<link itemprop="url" href="<?php echo Juri::base(); ?>">
				
				<?php
				if($contact->image)
				{
					if ($params->get('show_image'))
					{
						echo '<div>' . JHtml::_('image', $contact->image, $contact->name, array('itemprop' => 'image logo','class' => 'uk-thumbnail')) . '</div>';
					}
					else
					{
						echo '<link itemprop="logo image" href="' . $contact->image . '">';
					}
				}
				?>
				
				<?php if ($params->get('legal_name')) : ?>
				<meta itemprop="legalName" content="<?php echo $params->get('legal_name'); ?>" />
				<?php endif; ?>
				
				<?php if (is_array($params->get('alter_names')))
							{
								foreach($params->get('alter_names') as $value)
								{
									echo '<meta itemprop="alternateName" content="' . $value['name'] .'"/>';
								}
							}
				?>
				
				<?php if ($params->get('founding_date')) : ?>
				<meta itemprop="foundingDate" content="<?php echo $params->get('founding_date'); ?>" />
				<?php endif; ?>
				
				<?php if($params->get('show_info')) echo $this->loadTemplate('info'); ?>
				
				<?php if($params->get('show_links')) echo $this->loadTemplate('links'); ?>
				
			</div>
		</div>
		<div class="uk-width-1-1 uk-width-large-1-2">
			<div class="uk-panel">
				<?php echo $this->loadTemplate('map'); ?>
			</div>
		</div>
		<?php if($params->get('show_form')) : ?>
		<div class="uk-width-1-1">
			<div class="uk-panel">
				<?php echo $this->loadTemplate('form'); ?>
			</div>
		</div>
		<?php endif; ?>
	</article>
</div>