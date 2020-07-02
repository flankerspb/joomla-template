<?php
/**
 * @package     2sweb
 * @subpackage  Templates.2sweb
 *
 * @copyright   Copyright (C) 2018 Vitaliy Moskalyuk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// JLayoutHelper::$defaultBasePath = '\templates\2sweb\layouts';

$isContent = $this->isHome && !$this->params->get('homepage_content', 1) ? 0 : 1;
$isDebug = $this->params->get('debug_mode', 0) ? 0 : 1;


$logo = sprintf('content/images/logo_%s.png', substr(JFactory::getLanguage()->getTag(), 0, 2));
$logo_small = $this->params->get('logo_small');

$stiky = '';

// $stiky = ' data-uk-sticky="{media: 640, clsinit: \'sticky-init\', target: true}"';
// $stiky = " data-uk-sticky=\"{'media':640,'top':'.fl-block-header','animation': 'uk-animation-slide-top'}\"";

// $stiky = ' data-uk-sticky="{media: 640}"';

?>
<body class="<?php echo FlTemplate::getInputClass();?>">

	<header class="header">
	
		<?php if($this->countModules('toolbar-l')|| $this->countModules('toolbar-c') || $this->countModules('toolbar-r') || $this->countModules('language-switcher')) : ?>
			<div class="tm-toolbar uk-contrast uk-clearfix uk-hidden-small">
				<div class="uk-container uk-container-center">
					<div class="uk-flex uk-flex-middle uk-flex-space-between">
						<div class="">
							<jdoc:include type="modules" name="toolbar-l" style="blank" />
						</div>
						<div class="uk-text-center">
							<jdoc:include type="modules" name="toolbar-c" style="blank" />
						</div>
						<div class="uk-flex uk-flex-middle uk-flex-space-between fl-toolbar-r">
							<jdoc:include type="modules" name="toolbar-r" style="blank" />
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if($this->countModules('header-l')|| $this->countModules('header-c') || $this->countModules('header-r')) : ?>
			<div class="fl-header uk-clearfix uk-hidden-small">
				<div class="uk-container uk-container-center">
					<div class="uk-flex uk-flex-center uk-flex-middle uk-flex-space-between uk-text-center">
						<div class="fl-header-logo">
							<jdoc:include type="modules" name="header-l" style="blank" />
						</div>
						<div class="fl-header-search">
							<jdoc:include type="modules" name="header-c" style="blank" />
						</div>
						<div class="fl-contacts-header">
							<jdoc:include type="modules" name="header-r" style="blank" />
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
	</header>
	
	<?php if($this->countModules('menu')) : ?>
	<section id="nav">
		<div class="uk-navbar"<?php echo $stiky; ?>>
			<div class="uk-container uk-container-center">
				<nav class="fl-navbar uk-hidden-small">
					<ul class="uk-navbar-nav">
						<jdoc:include type="modules" name="menu" style="menu" />
					</ul>
					<?php if($this->countModules('logo-small')) : ?>
						<jdoc:include type="modules" name="logo-small" style="blank" />
					<?php endif; ?>
				</nav>
				<nav class="fl-navbar fl-navbar-small uk-visible-small">
					<?php if($this->countModules('offcanvas-left-top') || $this->countModules('offcanvas-left-menu') || $this->countModules('offcanvas-left-bottom')) : ?>
					<div>
						<a href="#offcanvas-left" class="uk-navbar-toggle" data-uk-offcanvas="{mode:'slide'}"></a>
					</div>
					<?php endif; ?>
					<div class="uk-text-center">
						<a class="fl-logo-small" href="/"><img src="/logo_small.png" alt="logo small"></a>
					</div>
					<?php if($this->countModules('offcanvas-right') || $this->countModules('offcanvas-toggle-right')) : ?>
					<div>
						<?php if($this->countModules('offcanvas-right')) : ?>
						<a href="#offcanvas-right" class="fl-offcanvas-right uk-navbar-toggle uk-navbar-flip" data-uk-offcanvas="{mode:'slide'}"></a>
						<?php endif; ?>
						<?php if($this->countModules('offcanvas-toggle-right')) : ?>
							<jdoc:include type="modules" name="offcanvas-toggle-right" style="blank" />
						<?php endif; ?>
					</div>
					<?php else : ?>
					<div>
						<div class="uk-invisible uk-navbar-toggle"></div>
					</div>
					<?php endif; ?>
				</nav>
			</div>
		</div>
	</section>
	<?php endif; ?>
	
	<?php if($this->countModules('top-a') || $this->countModules('top-b')) : ?>
		<section>
			<?php if($this->countModules('top-a')) : ?>
				<div class="tm-top tm-block-a">
						<jdoc:include type="modules" name="top-a" style="blank" />
				</div>
			<?php endif; ?>
			<?php if($this->countModules('top-b')) : ?>
				<div class="tm-top tm-block-b">
					<div class="uk-container uk-container-center">
						<jdoc:include type="modules" name="top-b" style="blank" />
					</div>
				</div>
			<?php endif; ?>
		</section>
	<?php endif; ?>
	
	<div id="stiky-breakpoint"></div>
	
	<jdoc:include type="message" />
	
	<main>
		
		<?php if($this->countModules('breadcrumbs')) : ?>
			<div class="tm-top tm-block-a">
				<div class="uk-container uk-container-center">
					<jdoc:include type="modules" name="breadcrumbs" style="blank" />
				</div>
			</div>
		<?php endif; ?>
		
		<?php if($this->countModules('main-top')) : ?>
			<jdoc:include type="modules" name="main-top" style="blank" />
		<?php endif; ?>
		
		<?php if($isContent) : ?>
		<div class="uk-block">
			<div class="uk-container uk-container-center">
				<jdoc:include type="component" />
			</div>
		</div>
		<?php endif; ?>
		
		<?php if($this->countModules('main-bottom')) : ?>
				<jdoc:include type="modules" name="main-bottom" style="blank" />
		<?php endif; ?>
		
	</main>
	
	<?php if($this->countModules('bottom-a') || $this->countModules('bottom-b')) : ?>
		<section class="tm-bottom">
			
				<?php if($this->countModules('bottom-a')) : ?>
					<div class="tm-block-a">
						<jdoc:include type="modules" name="bottom-a" style="blank" />
					</div>
				<?php endif; ?>
			<div class="uk-container uk-container-center">
				<?php if($this->countModules('bottom-b')) : ?>
					<div class="tm-block-b">
						<jdoc:include type="modules" name="bottom-b" style="blank" />
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
	
	<?php if($this->countModules('footer-a') || $this->countModules('footer-b')) : ?>
		<footer>
			<?php if($this->countModules('footer-a')) : ?>
				<div class="tm-footer uk-block-secondary uk-contrast">
					<div class="uk-container uk-container-center">
							<jdoc:include type="modules" name="footer-a" style="blank" />
					</div>
				</div>
			<?php endif; ?>
			<?php if($this->countModules('footer-b')) : ?>
				<div class="fl-footer-bottom uk-block-muted">
					<div class="uk-container uk-container-center">
						<jdoc:include type="modules" name="footer-b" style="blank" />
					</div>
				</div>
			<?php endif; ?>
		</footer>
	<?php endif; ?>
	
	<?php if($isDebug && $this->countModules('debug')) : ?>
		<jdoc:include type="modules" name="debug" style="blank" />
	<?php endif; ?>
	
	<?php if($this->countModules('offcanvas-left-top') || $this->countModules('offcanvas-left-menu') || $this->countModules('offcanvas-left-bottom')) : ?>
		<div id="offcanvas-left" class="uk-offcanvas">
			<div class="uk-offcanvas-bar">
				
				<?php if($this->countModules('offcanvas-left-top') || $this->countModules('language-switcher')) : ?>
				<div class="offcanvas-top">
				<jdoc:include type="modules" name="language-switcher" style="blank" />
				<jdoc:include type="modules" name="offcanvas-left-top" style="none" />
				</div>
				<?php endif; ?>
				
				<?php if($this->countModules('offcanvas-left-menu')) : ?>
				<nav>
					<ul class="uk-nav uk-nav-offcanvas">
					<jdoc:include type="modules" name="offcanvas-left-menu" style="none" />
					</ul>
				</nav>
				<?php endif; ?>
				
				<?php if($this->countModules('offcanvas-left-bottom')) : ?>
				<div class="offcanvas-bottom">
				<jdoc:include type="modules" name="offcanvas-left-bottom" style="none" />
				</div>
				<?php endif; ?>
				
			</div>
		</div>
	<?php endif; ?>
	
	<?php if($this->countModules('offcanvas-right')) : ?>
		<div id="offcanvas-right" class="uk-offcanvas">
			<div class="uk-offcanvas-bar uk-offcanvas-bar-flip uk-block">
				<jdoc:include type="modules" name="offcanvas-right" style="offcanvas" />
			</div>
		</div>
	<?php endif; ?>
	
	<?php if($this->countModules('modal')) : ?>
		<jdoc:include type="modules" name="modal" style="blank" />
	<?php endif; ?>
	
</body>