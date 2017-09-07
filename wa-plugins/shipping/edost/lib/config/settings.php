<?php
return array(
	'id' => array(
		'value' 		=> '',
		'length'		=> 6,
		'title2' 		=> 'Идентификатор магазина',
		'hint'			=> 'Скопируйте из настроек магазина в личном кабинете eDost.',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingInput',
	),
	'ps' => array(
		'value' 		=> '',
		'title2' 		=> 'Пароль для доступа к серверу расчетов',
		'hint'			=> 'Скопируйте из настроек магазина в личном кабинете eDost.',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingInput',
	),
	'host' => array(
		'value' 		=> '',
		'title2' 		=> 'Сервер расчета доставки',
		'note' 	=> 'указывать не обязательно',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingInput',
	),
	'hide_error' => array(
		'value' 		=> '',
		'title2' 		=> 'Скрывать ошибки',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
	'show_zero_tariff' => array(
		'value' 		=> '',
		'title2' 		=> 'Если расчет невозможен, тогда вывести нулевой тариф',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
	'send_zip' => array(
		'value' 		=> 'Y',
		'title2' 		=> 'Использовать в расчете почтовый индекс',
		'hint' 			=> 'Расчет по индексу действует только для почты (наземная посылка) и EMS.',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
	'sort_ascending' => array(
		'value' 		=> '',
		'title2' 		=> 'Сортировать тарифы по стоимости',
		'hint' 			=> 'Если включена сортировка по стоимости доставки, тогда сортировка по кодам из личного кабинета работать НЕ будет! <br><br> Также учитывайте, что при включении объединения тарифов по типу доставки, сортировка по стоимости будет производиться только внутри своей группы.',
		'warning' 		=> true,
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
/*
	'map' => array(
		'value' 		=> '',
		'title2' 		=> 'Включить выбор постаматов и пунктов выдачи',
		'hint' 			=> 'При использовании тарифов с доставкой до постамата / пункта выдачи / терминала, эта галочка должна стоять обязательно!',
		'warning' 		=> true,
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
*/
	'template_autoselect_office' => array(
		'value' 		=> '',
		'title2' 		=> 'Автоматически выбирать самый первый пункт выдачи или постамат',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
	'order_type' => array(
		'value' 		=> 'Y',
		'title2' 		=> 'Стандартное оформление заказа',
		'hint' 			=> 'Если в магазине используется НЕ стандартное оформление заказа, тогда дополнительный функционал модуля (учет габаритов, выбор пунктов выдачи на карте, расширенное редактирование заказа и т.д.) работать НЕ будет!',
		'warning' 		=> true,
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
	'admin' => array(
		'value' 		=> 'Y',
		'title2' 		=> 'Включить расширенное редактирование заказа в админке',
		'hint' 			=> 'Данная функция добавляет на страницу редактирования заказов возможность выбора пунктов выдачи, учет наложенного платежа, вывод ошибок и предупреждений калькулятора.<br><br><b>Предупреждение!!!</b><br><b>1.</b> Используется механизм прямой интеграции в функционал магазина, поэтому возможны конфликты с другими модулями и новыми функциями webasyst! <br> Если такое произошло, тогда просто уберите галочку, и все вернется к стандарту.<br><b>2.</b> При использовании расширенного редактирования и тарифов с доставкой до постамата / пункта выдачи / терминала, обязательно должен быть установлен шаблон eDost!',
		'warning' 		=> true,
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
/*
	'autoselect' => array(
		'value' 		=> 'Y',
		'title2' 		=> 'Автоматически выбирать самый первый способ доставки',
		'description' 	=> '',
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingCheckbox',
	),
*/
	'template_format' => array(
		'value' 		=> 'off',
		'title2' 		=> 'Объединять тарифы по типу доставки',
		'options'		=> array('off' => 'отключено', 'odt' => 'самовывоз, курьер, почта', 'dot' => 'курьер, самовывоз, почта', 'tod' => 'почта, самовывоз, курьер'),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingSelect',
	),
	'template_block' => array(
		'value' 		=> 'off',
		'title2' 		=> 'Выводить тарифы одного типа отдельными блоками',
		'options'		=> array('off' => 'отключено', 'auto1' => 'только когда много тарифов', 'auto2' => 'только когда много тарифов любого типа', 'all' => 'всегда'),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingSelect',
	),
	'template_block_type' => array(
		'value' 		=> 'none',
		'title2' 		=> 'Формат отображения',
		'options'		=> array('none' => 'блоки', 'border' => 'блоки с рамкой'),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingSelect',
	),
	'template_cod' => array(
		'value' 		=> 'off',
		'title2' 		=> 'Наложенный платеж',
		'options'		=> array('off' => 'только в способах оплаты', 'td' => 'дублировать в колонке у тарифа доставки'),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingSelect',
	),
	'tariff' => array(
		'value' 		=> array(),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingTariff',
	),
	'hidden' => array(
		'value' 		=> array('server' => '', 'server_zip' => ''),
		'control_type'	=> waHtmlControl::CUSTOM.' edostShipping::settingHidden',
	),
);
