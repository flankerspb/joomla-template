<?php 
/**
* @version      4.15.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die();

$user = $this->user;
$config_fields = $this->config_fields;
$order = JTable::getInstance('order', 'jshop');
$orders = $order->getOrdersForUser($user->user_id);

$name = array();
if($user->f_name)
	$name[] = $user->f_name;
if($user->f_name)
	$name[] = $user->m_name;
if($user->l_name)
	$name[] = $user->l_name;


$name = implode(' ', $name);


?>
<div class="jshop" id="comjshop">

	<h1>Профиль</h1>
	<table class="uk-table fl-table-auto">
		<tbody>
			<tr>
				<td><b>Личные данные</b></td>
				<td class="uk-text-right"><a href="<?php echo $this->href_edit_data?>">изменить</a></td>
			</tr>
			<tr>
				<td>Логин (E-mail):</td>
				<td><?php echo $user->email;?></td>
			</tr>
			<tr>
				<td>Клиент:</td>
				<td><?php echo constant('_JSHOP_CLIENT_TYPE_' . $user->client_type);?></td>
			</tr>
			<?php if($user->client_type == 2) : ?>
			<tr>
				<td><?php echo _JSHOP_CLIENT_TYPE_2;?>:</td>
				<td><?php echo $user->firma_name;?></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>Имя:</td>
				<td><?php echo $name;?></td>
			</tr>
			<tr>
				<td>Телефон:</td>
				<td><?php echo $user->phone;?></td>
			</tr>
			<tr>
				<td><b>Адрес доставки</b></td>
				<td class="uk-text-right"><a href="<?php echo $this->href_edit_data?>?delivery">изменить</a></td>
			</tr>
			<tr>
				<td><?php echo _JSHOP_ZIP ?>:</td>
				<td><?php echo $user->d_zip;?></td>
			</tr>
			<tr>
				<td><?php echo _JSHOP_STATE ?>:</td>
				<td><?php echo $user->d_state;?></td>
			</tr>
			<tr>
				<td><?php echo _JSHOP_CITY ?>:</td>
				<td><?php echo $user->d_city;?></td>
			</tr>
			<tr>
				<td><?php echo _JSHOP_STREET_NR ?>:</td>
				<td><?php echo $user->d_street;?></td>
			</tr>
		</tbody>
	</table>
	
	<div class="uk-margin-top">
		<a class="uk-button" href="<?php echo $this->href_edit_data?>?password">Изменить пароль</a>
	</div>
	
</div>