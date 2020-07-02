<?php

defined('JPATH_BASE') or die;

// var_dump($displayData);


$itemprop = $displayData['itemprop'] ? 'itemprop="'.$displayData['itemprop'].'"' : '';

?>
<div class="fl-header">
<div class="fl-block-header uk-contrast">
	
		<div class="uk-container uk-container-center uk-text-right">
			<h1 <?php echo $itemprop; ?>>
				<?php if($displayData['top']): ?>
				<span class="uk-h3 fl-top-header">
					<?php echo $displayData['top']; ?>
				</span>
				<?php elseif($displayData['top1'] || $displayData['top2']): ?>
				<span class="uk-h3 fl-top-header">
					<span><?php echo $displayData['top1']; ?></span>
					<span class="fl-path"><?php echo $displayData['top2']; ?></span>
				</span>
				<?php elseif($displayData['latin']): ?>
				<span class="uk-h3 latin fl-top-header">
					<?php echo $displayData['latin']; ?>
				</span>
				<?php elseif($displayData['latin1'] || $displayData['latin2']): ?>
				<span class="uk-h3 latin fl-top-header">
					<span><?php echo $displayData['latin1']; ?></span>
					<span class="fl-path"><?php echo $displayData['latin2']; ?></span>
				</span>
				<?php else : ?>
				<span class="uk-h3 fl-top-header"></span>
				<?php endif; ?>
				<?php if($displayData['main']): ?>
				<span class="uk-h1 fl-main-header"><?php echo $displayData['main']; ?></span>
				<?php endif; ?>
				<?php if($displayData['mainlatin']): ?>
				<span class="uk-h1 latin fl-main-header"><?php echo $displayData['mainlatin']; ?></span>
				<?php endif; ?>
			</h1>
		</div>
	</div>
</div>
