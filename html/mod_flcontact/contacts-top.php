<?php
// no direct access
defined( '_JEXEC' ) or die();

// var_dump($contact->params);

$info = array();

$phone_class = ['class' => 'uk-link'];
$phone_trim = ['+7', ' '];

if ($is_show->telephone && $contact->telephone != '')
{
	$info['phone'] = ModFlcontactHelper::phoneLink($contact->telephone, $phone_trim, $phone_clas);
}

if ($is_show->mobile && $contact->mobile != '')
{
	$class = 'uk-link';
	$info['mobile'] = ModFlcontactHelper::phoneLink($contact->mobile, $phone_trim, $phone_clas);
}
if ($is_show->fax && $contact->fax != '')
{
	$class = 'uk-link';
	$info['fax'] = ModFlcontactHelper::phoneLink($contact->fax, $phone_trim, $phone_clas);
}

if ($is_show->email_to && $contact->email_to != '')
{
	$info['email'] = JHtml::_('email.cloak', $contact->email_to, true);
}

?>
<div class="uk-panel">
	<?php foreach($info as $key => $value): ?>
		<div class="fl-<?php echo $key; ?>">
			<?php echo $value; ?>
		</div>
	<?php endforeach; ?>
</div>
