<?php
return array(
	// Внутрисистемная маршрутизация RECALL
	'shop_recall_routing' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'domain' => array('varchar', 255, 'null' => 0),
		'url' => array('varchar', 255, 'null' => 0),
		'theme_id' => array('varchar', 255, 'null' => 0),
		':keys' => array(
			'PRIMARY' => 'id',
		),
	),
	// Запросы
	'shop_recall_requests' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'url' => array('varchar', 255, 'null' => 0),
		'product_id' => array('int', 11, 'null' => 1),
		'contact_id' => array('int', 11, 'null' => 1),
		'referrer_name' => array('varchar', 255, 'null' => 0),
		'referrer_phone' => array('varchar', 255, 'null' => 1),
		'referrer_email' => array('varchar', 255, 'null' => 1),
		'request_text' => array('text', 'null' => 1),
		'status_code' => array('int', 11, 'null' => 1),
		'deploy_time' => array('datetime', 'null' => 0),
		'user_ip' => array('varchar', 20, 'null' => 0),
		'is_new' => array('int', 11, 'null' => 1),
		':keys' => array(
							'PRIMARY' => 'id',
							'request_text' => array('request_text', 'fulltext' => 1),
						),
	),
	// Статусы запросов
	'shop_recall_status' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'name' => array('varchar', 255, 'null' => 0),
		'color' => array('varchar', 32, 'null' => 0),
		'request_count' => array('varchar', 255, 'null' => 0, 'default' => 0),
		'sort' => array('int', 11, 'null' => 0, 'default' => -1),
		':keys' => array(
							'PRIMARY' => 'id',
						),
	),
	// История запросов
	'shop_recall_history' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'request_id' => array('int', 11, 'null' => 0),
		'user_id' => array('int', 11, 'null' => 0),
		'comment' => array('text', 'null' => 0),
		'deploy_time' => array('datetime', 'null' => 0),
		':keys' => array(
							'PRIMARY' => 'id',
						),
	),
	// Дополнительные поля
	'shop_recall_field' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'name' => array('varchar', 255, 'null' => 0),
		'visible' => array('int', 11, 'null' => 0),
		'must_be' => array('int', 11, 'null' => 0),
		'type' => array('varchar', 255, 'null' => 0),
		':keys' => array(
							'PRIMARY' => 'id',
						),
	),
	// Значения дополнительных полей
	'shop_recall_field_values' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'name' => array('varchar', 255, 'null' => 0),
		'field_id' => array('int', 11, 'null' => 0),
		':keys' => array(
							'PRIMARY' => 'id',
						),
	),
	// Дополнительные поля в запросах
	'shop_recall_request_extra' => array(
		'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
		'request_id' => array('int', 11, 'null' => 0),
		'field_name' => array('varchar', 255, 'null' => 0),
		'field_text' => array('text', 'null' => 1),
		':keys' => array(
							'PRIMARY' => 'id',
						),
	),
);