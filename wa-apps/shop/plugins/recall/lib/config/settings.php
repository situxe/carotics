<?php

return array(
		'dheader' => array(
			'title' => _wp('Заголовок окна'),
			'value' => 'Обратный звонок',
			'description' => _wp('Заголовок окна'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dwindow' => array(
			'title' => _wp('Дисклеймер окна'),
			'value' => 'Вам перезвонят',
			'description' => _wp('Дисклеймер окна'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dname' => array(
			'title' => _wp('Описание поля имени'),
			'value' => 'Ваше имя',
			'description' => _wp('Описание поля имени'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dphone' => array(
			'title' => _wp('Описание поля телефона'),
			'value' => 'Телефон для обратной связи',
			'description' => _wp('Описание поля телефона'),
			'control_type' => waHtmlControl::INPUT,
		),
		'demail' => array(
			'title' => _wp('Описание поля email'),
			'value' => 'E-mail',
			'description' => _wp('Описание поля email'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dcomment' => array(
			'title' => _wp('Описание поля комментария'),
			'value' => 'Краткое описание Вашего вопроса',
			'description' => _wp('Описание поля комментария'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dsubmit' => array(
			'title' => _wp('Текст на кнопке отправки'),
			'value' => 'Отправить запрос',
			'description' => _wp('Текст на кнопке отправки'),
			'control_type' => waHtmlControl::INPUT,
		),
		'dsuccess' => array(
			'title' => _wp('Уведомление об успешной отправке'),
			'value' => 'Ваш запрос отправлен. Номер запроса: %req_num%',
			'description' => _wp('Текст на кнопке отправки'),
			'control_type' => waHtmlControl::INPUT,
		),
		'tab_name' => array(
			'title' => _wp('Имя вкладки в бекенде'),
			'value' => 'Обратная связь',
			'description' => _wp('Имя вкладки в бекенде'),
			'control_type' => waHtmlControl::INPUT,
		),
		'captcha' => array(
			'title' => _wp('Включить CAPTCHA'),
			'value' => 0,
			'description' => _wp('Защита формы отправки с помощью CAPTCHA'),
			'control_type' => waHtmlControl::CHECKBOX,
		),
		'notification' => array(
			'title' => _wp('E-mail уведомления'),
			'value' => 0,
			'description' => _wp('Включить уведомления о новых запросах'),
			'control_type' => waHtmlControl::CHECKBOX,
		),
		'adminmail' => array(
			'title' => _wp('E-mail администратора'),
			'value' => '',
			'description' => _wp('Адрес для отправки уведомлений'),
			'control_type' => waHtmlControl::INPUT,
		),
		'recallmail' => array(
			'title' => _wp('E-mail в поле "от кого" в уведомлениях'),
			'value' => '',
			'description' => _wp('E-mail в поле "от кого" в уведомлениях'),
			'control_type' => waHtmlControl::INPUT,
		),
		'nsubject' => array(
			'title' => _wp('Тема уведомления'),
			'value' => 'Новый запрос обратного звонка',
			'description' => _wp('Тема уведомления'),
			'control_type' => waHtmlControl::INPUT,
		),
		'askaboutproduct' => array(
			'title' => _wp('Включить функцию "Спросить о товаре"'),
			'value' => 0,
			'description' => _wp('Добавляет соответствующую кнопку на страницу продукта'),
			'control_type' => waHtmlControl::CHECKBOX,
		),
		'askaboutproducttext' => array(
			'title' => _wp('Текст на кнопке "Спросить о товаре"'),
			'value' => 'Спросить о товаре',
			'description' => _wp('Текст на кнопке "Спросить о товаре"'),
			'control_type' => waHtmlControl::INPUT,
		),
		'askforemail' => array(
			'title' => _wp('Запрашивать e-mail покупателя'),
			'value' => 'yes',
			'description' => _wp('Включить поле запроса e-mail'),
			'control_type' => waHtmlControl::INPUT,
		),
    );