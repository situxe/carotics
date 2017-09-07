<?php

class shopRecallPluginFrontendSendRequestController extends waJsonController
{
    public function execute()
    {
		$db = new waModel();
		$validator = new waEmailValidator();
		// Получение и проверка данных
		
		// CAPTCHA
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		if($recall_plugin->getSettings('captcha'))
		{
			if(!wa()->getCaptcha()->isValid()) 
			{
				$this->response = array('result'=>'error', 'error'=>'Неверно введена captcha', 'cpt'=>$recall_plugin->getSettings('captcha')); return;
			}
		}
		
		// Имя
		$user_name = waRequest::post('username');
		if(strlen($user_name) == 0) {$this->response = array('result'=>'error', 'error'=>'Пожалуйста, введите имя'); return;}
		$user_name = htmlspecialchars($user_name, ENT_QUOTES);
		$user_name = $db->escape($user_name);
		
		// Телефон и email
		// Телефон
		$phone = waRequest::post('phone');
		if(!$phone) {$this->response = array('result'=>'error', 'error'=>'Для отправки запроса необходимо указать номер телефона'); return;}
		if(strlen($phone) == 0) {$this->response = array('result'=>'error', 'error'=>'Для отправки запроса необходимо указать номер телефона'); return;}
		$phone = htmlspecialchars($phone, ENT_QUOTES);
		$phone = $db->escape($phone);
		
		// Email
		$askforemail = $recall_plugin->getSettings('askforemail');
		$email = waRequest::post('email');
		
		// Обязательный запрос e-mail
		if($askforemail == 'yes')
		{
			if(!$email) {$this->response = array('result'=>'error', 'error'=>'Для отправки запроса необходимо указать e-mail'); return;}
			if(strlen($email) == 0) {$this->response = array('result'=>'error', 'error'=>'Для отправки запроса необходимо указать e-mail'); return;}
			if(!$validator->isValid($email)) {$this->response = array('result'=>'error', 'error'=>'Проверьте правильность ввода email'); return;}
		}
		// Необязательный запрос e-mail
		if($askforemail == 'nevermind')
		{
			if($email)
			{
				if(strlen($email) > 0)
				{
					if(!$validator->isValid($email)) {$this->response = array('result'=>'error', 'error'=>'Проверьте правильность ввода email'); return;}
				}
				else {$email = '';}
			}
			else {$email = '';}
		}
		// Не запрашивать e-mail
		if(!($askforemail == 'yes' || $askforemail == 'nevermind')) {$email = '';}
		
		$email = htmlspecialchars($email, ENT_QUOTES);
		$email = $db->escape($email);
		
		// Комментарий
		$comment = waRequest::post('comment');
		$comment = htmlspecialchars($comment, ENT_QUOTES);
		$comment = $db->escape($comment);
		
		// ID контакта
		$contact_id = intval(waRequest::post('contact'));
		if($contact_id == -1) {$contact_id = 'NULL';}
		
		// ID продукта
		$product_id = intval(waRequest::post('product'));
		if($product_id == -1) {$product_id = 'NULL';}
		
		// URL запроса
		$url = waRequest::post('url');
		$url = htmlspecialchars($url, ENT_QUOTES);
		$url = $db->escape($url);
		
		// IP
		$ip = $db->escape(htmlspecialchars(waRequest::server('REMOTE_ADDR'), ENT_QUOTES));
		
		// Дополнительные поля
		$fields = waRequest::post('fields');
		$processed_fields = array();
		if($fields)
		{
			foreach($fields as $key=>$value)
			{
				$field_data = $db->query("SELECT name, must_be, type FROM shop_recall_field WHERE id=".intval($key))->fetchAll();
				if(count($field_data))
				{
					$current_field = array('name' => $field_data[0]['name'], 'type' => $field_data[0]['type']);
					// text
					if($current_field['type'] == 'text') {$current_field['value'] = $db->escape(htmlspecialchars($value['value'], ENT_QUOTES));}
					// range
					if($current_field['type'] == 'range') 
					{
						if(isset($value['value'][0]) && isset($value['value'][1]))
						{
							if(strlen($value['value'][0]) > 0 && strlen($value['value'][1]) > 0)
							{
								$current_field['value'] = $db->escape(htmlspecialchars($value['value'][0], ENT_QUOTES)).' - '.$db->escape(htmlspecialchars($value['value'][1], ENT_QUOTES));
							}
						}
					}
					// select
					if($current_field['type'] == 'select')
					{
						$ival = $db->query("SELECT name FROM shop_recall_field_values WHERE id=".intval($value['value']))->fetchAll();
						if(count($ival) > 0) {$current_field['value'] = $db->escape($ival[0]['name']);}
					}
					// checkbox
					if($current_field['type'] == 'checkbox')
					{
						$current_field['value'] = '';
						foreach($value['value'] as $vkey=>$vval)
						{
							$ival = $db->query("SELECT name FROM shop_recall_field_values WHERE id=".intval($vkey))->fetchAll();
							if(count($ival) > 0) 
							{
								if(strlen($current_field['value']) > 0) {$current_field['value'] .= ', ';}
								$current_field['value'] .= $db->escape($ival[0]['name']);
							}
						}
					}
				}
				$processed_fields[intval($key)] = $current_field;
			}
		}
		// Проверка обязательных полей
		$required_fields = $recall_plugin->getRequiredFields();
		if(count($required_fields) > 0)
		{
			foreach($required_fields as $rkey=>$rvalue)
			{
				if(!isset($processed_fields[$rvalue['id']])) 
				{
					$this->response = array('result'=>'error', 'error'=>'Пожалуйста, заполните обязательное поле "'.$rvalue['name'].'"'); 
					return;
				}
				if(!isset($processed_fields[$rvalue['id']]['value']))
				{
					$this->response = array('result'=>'error', 'error'=>'Пожалуйста, заполните обязательное поле "'.$rvalue['name'].'"'); 
					return;
				}
				else
				{
					if(strlen($processed_fields[$rvalue['id']]['value']) == 0)
					{
						$this->response = array('result'=>'error', 'error'=>'Пожалуйста, заполните обязательное поле "'.$rvalue['name'].'"'); 
						return;
					}
				}
			}
		}
		
		// Сохранение записи
		$request_id = $db->query("INSERT INTO `shop_recall_requests` (`url`, `contact_id`, `product_id`, `referrer_name`, `referrer_phone`, `referrer_email`, `request_text`, `status_code`, `user_ip`, `deploy_time`) 
					VALUES ('".$url."', ".$contact_id.", ".$product_id.", '".$user_name."', '".$phone."', '".$email."', '".$comment."', NULL, '".$ip."', NOW());")->lastInsertId();
		
		// Заполнение дополнительных полей
		if(count($processed_fields) > 0)
		{
			foreach($processed_fields as $pkey=>$pvalue)
			{
				if(isset($pvalue['value']))
				{
					$db->query("INSERT INTO shop_recall_request_extra (`request_id`, `field_name`, `field_text`) 
								VALUES ('".$request_id."', '".$pvalue['name']."', '".$pvalue['value']."')");
				}
			}
		}
		
		
		$return_message = str_replace("%req_num%", $request_id ,$recall_plugin->getSettings('dsuccess'));
		
		// Уведомление
		if($recall_plugin->getSettings('notification'))
		{
			$admin_email = $recall_plugin->getSettings('adminmail');
			$recall_mail = $recall_plugin->getSettings('recallmail');
			
			// NEED TO CHECK EMAILS
			if($validator->isValid($admin_email) && $validator->isValid($recall_mail))
			{
				
				$subject = $recall_plugin->getSettings('nsubject');
				$message = '
					<html>
					<head>
					 <title>'.$recall_plugin->getSettings('nsubject').'</title>
					</head>
					<body>
					<p>Новый запрос обратного звонка</p>
					<p>Пользователь '.$user_name.' только что оставил заявку на обратный звонок.</p>
					<p>Ссылка на заявку: '.wa()->getRootUrl(true, true).wa()->getConfig()->getBackendUrl().'/shop/?plugin=recall&module=backend&action=control&rc_onload='.$request_id.'</p>
					<p>Это письмо сгенерировано автоматически плагином RECALL. Не отвечайте на него.</p>
					</body>
					</html>
				';
				
				$mail_message = new waMailMessage($subject, $message);
				$mail_message->setFrom($recall_mail, 'Плагин RECALL');
				$mail_message->setTo($admin_email, 'Администратор магазина');
				$mail_message->addCc($recall_mail, 'Плагин RECALL');
				$mail_message->addBcc($recall_mail, 'Плагин RECALL');
				$mail_message->send();
			}
		}
		
		$this->response = array('result'=>'ok', 'message' => $return_message, 'fields_p'=>$processed_fields);
    }
}