<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$description = '';

if($this->params->get('show_base_description'))
{
	if($this->params->get('categories_description'))
	{
		$description = JHtml::_('content.prepare', $this->params->get('categories_description'), '',  $this->get('extension') . '.categories');
	}
	else
	{
		if($this->parent->description)
		{
			$description = JHtml::_('content.prepare', $this->parent->description, '', $this->parent->extension . '.categories');
		}
	}
}

$header = array();
$header['main'] = $this->escape($this->params->get('page_heading'));
$header['itemprop'] = 'name';

?>
<div itemscope itemtype="https://schema.org/ItemList">
	<?php echo JLayoutHelper::render('2sweb.page.header', $header); ?>
	<link itemprop="url" href="<?php echo Juri::current(); ?>">
	<div class="fl-page-collections uk-text-center">
		<div class="uk-container uk-container-center">
			<?php echo $this->loadTemplate('items'); ?>
		</div>
	</div>
</div>
