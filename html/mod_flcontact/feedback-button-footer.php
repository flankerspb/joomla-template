<?php
// no direct access
defined( '_JEXEC' ) or die();

// var_dump($contact->params);

$info = array();

$phone_class = ['class' => 'uk-link'];
$phone_trim = ['+7', ' '];

if ($is_show->telephone && $contact->telephone != '')
{
	$class = 'uk-link';
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
<div class="uk-block uk-contrast fl-contacts-question">
	<div class="uk-container uk-container-center">
		<div class="uk-panel uk-text-center">
			<div class="uk-grid uk-grid-margin uk-flex uk-flex-center uk-flex-middle uk-margin-top-remove" data-uk-grid-margin>
				<div class="uk-width-1-1 uk-width-medium-1-3">
					<div class="uk-panel">
						<p class="uk-text-large">Нужна помощь с выбором?<br>Хотите посмотреть образцы?<br>Есть вопросы?</p>
					</div>
				</div>
				<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3">
					<div class="uk-panel">
						<?php foreach($info as $key => $value): ?>
							<p class="fl-<?php echo $key; ?>">
								<?php echo $value; ?>
							</p>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="uk-width-1-1 uk-width-small-1-2 uk-width-medium-1-3">
					<div class="uk-panel">
						<a href="#feedback" class="uk-button"><b>Оставить заявку</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
