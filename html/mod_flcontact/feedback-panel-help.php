<?php
// no direct access
defined( '_JEXEC' ) or die();

// var_dump($contact->params);

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

if ($is_show->email_to && $contact->email_to != '')
{
	$info['email'] = JHtml::_('email.cloak', $contact->email_to, true);
}

?>
<div class="uk-block">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-collapse" data-uk-grid-match="{row: false, target:'.uk-panel'}">
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-4">
				<div class="uk-panel uk-panel-box uk-panel-box-primary uk-text-center uk-contrast">
					<h3 class="uk-panel-title">Наши специалисты готовы Вам помочь!</h3>
					<img src="/icons/phone.png" alt="phone" class="fl-icon-help-phone">
					<a href="#feedback" class="uk-button"><span>Заказать звонок</span></a>
				</div>
			</div>
			<div class="uk-width-1-1 uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-3-4">
				<div class="uk-panel uk-panel-body">
					<h3 class="uk-panel-title">Оригинальные сувениры для бизнеса с нанесением</h3>
					<p class="uk-text-large">Главная задача каждой компании — привлекать новых клиентов. Расширить аудиторию потенциальных покупателей и повысить их лояльность помогут бизнес-сувениры компании «Апельбург». Ежедневно мы отгружаем клиентам 1500 готовых изделий, которые используются на выставках, промоакциях, конференциях и фестивалях. Среди наших постоянных клиентов: Газпром, Semrush, Suprotec, Банк Санкт-Петербург и другие.<br>Доверьте рекламу бизнеса профессионалам и закажите корпоративные подарки в компании «Матрёшки»!</p>
				</div>
			</div>
		</div>
	</div>
</div>