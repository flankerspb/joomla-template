<?php
// no direct access
defined( '_JEXEC' ) or die();

$info = array();

if ($is_show->telephone && $contact->telephone != '')
{
	$class = 'uk-link';
	$info['phone'] = ModFlcontactHelper::phoneLink($contact->telephone, array('class' => $class));
}

if ($is_show->mobile && $contact->mobile != '')
{
	$class = 'uk-link';
	$info['phone'] = ModFlcontactHelper::phoneLink($contact->mobile, array('class' => $class));
}

if ($is_show->fax && $contact->fax != '')
{
	$class = 'uk-link';
	$info['fax'] = ModFlcontactHelper::phoneLink($contact->fax, array('class' => $class));
}

if ($is_show->fax && $contact->email_to != '')
{
	$info['email'] = JHtml::_('email.cloak', $contact->email_to, true);
}

?>
<div class="uk-margin-top uk-text-center">
	<?php foreach($info as $key => $value): ?>
		<p class="fl-<?php echo $key; ?> uk-contrast">
			<?php echo $value; ?>
		</p>
	<?php endforeach; ?>
</div>