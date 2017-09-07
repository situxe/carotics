<?php

class shopRecallPluginBackendActions extends waJsonActions
{	
	public function resetThemeAction()
	{
		$theme_id = waRequest::post('theme_id');
		$theme_id = preg_replace("([^0-9A-z])", "", $theme_id);
		
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		if($recall_plugin->themeHasCopy($theme_id))
		{
			$theme_base_dir = dirname(__FILE__).'/../../../../../../../wa-data/public/shop/plugins/recall/themes/'.$theme_id.'/';
			waFiles::delete($theme_base_dir);
			$this->response = array('result'=>'ok', 'message'=>'Все изменения темы дизайна сброшены.');
		}
		
		else {$this->response = array('result'=>'ok', 'message'=>'Не зафиксировано изменений темы. Сбрасывать нечего.');}
	}
	
	public function loadThemeAction()
	{
		$theme_id = waRequest::post('theme_id');
		$theme_id = preg_replace("([^0-9A-z])", "", $theme_id);
		
		// Получение пути до темы дизайна
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$theme_base_dir = dirname(__FILE__).'/../../../themes/'.$theme_id.'/';
		$base_dir = 'wa-apps/shop/plugins/recall/';
		if($recall_plugin->themeHasCopy($theme_id))
		{
			$theme_base_dir = dirname(__FILE__).'/../../../../../../../wa-data/public/shop/plugins/recall/themes/'.$theme_id.'/';
			$base_dir = 'wa-data/public/shop/plugins/recall/';
		}
		
		// CSS
		$theme_css = file_get_contents($theme_base_dir.'theme.css');
		$default_theme_css = file_get_contents($theme_base_dir.'theme_default.css');
		// IMAGES
		$theme_img = array(
							'hat' => '/themes/'.$theme_id.'/img/hat.png',
							'close' => '/themes/'.$theme_id.'/img/close.png',
							'close_hover' => '/themes/'.$theme_id.'/img/close_hover.png',
							'header' => '/themes/'.$theme_id.'/img/header.png',
							'footer' => '/themes/'.$theme_id.'/img/footer.png',
							'send' => '/themes/'.$theme_id.'/img/send.png',
							'send_hover' => '/themes/'.$theme_id.'/img/send_hover.png',
							'label' => '/themes/'.$theme_id.'/img/label.png',
						  );
		// INFO
		$info = require_once $theme_base_dir.'info.php';
		// SETTINGS
		$settings = file_get_contents($theme_base_dir.'settings.cfg');
		
		$settings = $recall_plugin->parseConfig($settings);
		
		$this->response = array('basedir'=>$base_dir, 'css'=>$theme_css, 'default_css'=>$default_theme_css, 'img'=>$theme_img, 'info'=>$info, 'settings'=>$settings, 'result'=>'ok');
	}
	
	public function saveThemeSettingsAction()
	{
		$theme_id = waRequest::post('theme_id');
		if(!$theme_id) {$this->response = array('result'=>'error', 'error'=>'Не удалось определить целевую тему оформления'); return;}
		$theme_id = preg_replace("([^0-9A-z])", "", $theme_id);
		
		// Резервное копирование
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		if(!$recall_plugin->themeHasCopy($theme_id)) {$copy = $recall_plugin->createThemeCopy($theme_id);}
		else {$copy = 1;}
		if($copy == 0) {$this->response = array('result'=>'error', 'error'=>'Не удалось сохранить тему оформления. Проверьте права на запись для директории /wa-data/public/shop/.'); return;}
		$theme_base_dir = dirname(__FILE__).'/../../../../../../../wa-data/public/shop/plugins/recall/themes/';
		//
		
		$theme_itype = waRequest::post('itype');
		$theme_itype = preg_replace("([^A-z])", "", $theme_itype);
		
		$theme_hook = waRequest::post('hook');
		$theme_hook = preg_replace("([^0-9A-z_-])", "", $theme_hook);
		
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$config = $recall_plugin->createConfig(array('itype' => $theme_itype, 'hook'=>$theme_hook));
		
		if(file_put_contents($theme_base_dir.$theme_id.'/settings.cfg', $config) !== FALSE) 
		{
			$this->response = array('result'=>'error', 'error'=>'Не удалось сохранить тему оформления. Проверьте права на запись для файлов темы.');
		}
		$this->response = array('result'=>'ok');
	}
	
	public function saveThemeCssAction()
	{
		$theme_id = waRequest::post('theme_id');
		if(!$theme_id) {$this->response = array('result'=>'error', 'error'=>'Не удалось определить целевую тему оформления'); return;}
		$theme_id = preg_replace("([^0-9A-z])", "", $theme_id);
		
		// Резервное копирование
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		if(!$recall_plugin->themeHasCopy($theme_id)) {$copy = $recall_plugin->createThemeCopy($theme_id);}
		else {$copy = 1;}
		if($copy == 0) {$this->response = array('result'=>'error', 'error'=>'Не удалось сохранить тему оформления. Проверьте права на запись для директории /wa-data/public/shop/.'); return;}
		$theme_base_dir = dirname(__FILE__).'/../../../../../../../wa-data/public/shop/plugins/recall/themes/';
		//
		
		$css = waRequest::post('css');
		
		if(file_put_contents($theme_base_dir.$theme_id.'/theme.css', $css) !== FALSE) 
		{
			$this->response = array('result'=>'error', 'error'=>'Не удалось сохранить тему оформления. Проверьте права на запись для директории /wa-data/public/shop/recall/themes/.');
		}
		$this->response = array('result'=>'ok', 'path'=>$path);
	}
	
	public function saveThemeImagesAction()
	{
		$theme_id = waRequest::post('theme_id');
		if(!$theme_id) {$this->response = array('result'=>'error', 'error'=>'Не удалось определить целевую тему оформления'); return;}
		$theme_id = preg_replace("([^0-9A-z])", "", $theme_id);
		
		// Резервное копирование
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		if(!$recall_plugin->themeHasCopy($theme_id)) {$copy = $recall_plugin->createThemeCopy($theme_id);}
		else {$copy = 1;}
		if($copy == 0) {$this->response = array('result'=>'error', 'error'=>'Не удалось сохранить тему оформления. Проверьте права на запись для директории /wa-data/public/shop/.'); return;}
		$theme_base_dir = dirname(__FILE__).'/../../../../../../../wa-data/public/shop/plugins/recall/themes/';
		//
		
		$files_updated = 0;
		$errors = '';
		
		// HAT
		$file = waRequest::file('rc_image_hat');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'hat.png');
				$files_updated++;
			}
			else {$errors += 'Файл шапки не соответствует формату и не будет обновлен\n';}
		}
		
		// CLOSE
		$file = waRequest::file('rc_image_close');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'close.png');
				$files_updated++;
			}
			else {$errors += 'Файл кнопки закрытия не соответствует формату и не будет обновлен\n';}
		}
		
		// CLOSE ACTIVE
		$file = waRequest::file('rc_image_close_hover');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'close_hover.png');
				$files_updated++;
			}
			else {$errors += 'Файл кнопки закрытия в активном состоянии не соответствует формату и не будет обновлен\n';}
		}
		
		// HEADER
		$file = waRequest::file('rc_image_header');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'header.png');
				$files_updated++;
			}
			else {$errors += 'Файл верхней части рабочей области не соответствует формату и не будет обновлен\n';}
		}
		
		// FOOTER
		$file = waRequest::file('rc_image_close');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'footer.png');
				$files_updated++;
			}
			else {$errors += 'Файл нижней части рабочей области не соответствует формату и не будет обновлен\n';}
		}
		
		// SEND
		$file = waRequest::file('rc_image_send');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'send.png');
				$files_updated++;
			}
			else {$errors += 'Файл кнопки запроса не соответствует формату и не будет обновлен\n';}
		}
		
		// SEND_HOVER
		$file = waRequest::file('rc_image_send_hover');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'send_hover.png');
				$files_updated++;
			}
			else {$errors += 'Файл кнопки запроса в активном состоянии не соответствует формату и не будет обновлен\n';}
		}
		
		// LABEL
		$file = waRequest::file('rc_image_label');
		if($file->uploaded())
		{
			if($file->type == 'image/png')
			{
				$file->moveTo($theme_base_dir.$theme_id.'/img/', 'label.png');
				$files_updated++;
			}
			else {$errors += 'Файл ярлыка вызова окна не соответствует формату и не будет обновлен\n';}
		}
		
		// IMAGES
		$theme_img = array(
							'hat' => '/themes/'.$theme_id.'/img/hat.png',
							'close' => '/themes/'.$theme_id.'/img/close.png',
							'close_hover' => '/themes/'.$theme_id.'/img/close_hover.png',
							'header' => '/themes/'.$theme_id.'/img/header.png',
							'footer' => '/themes/'.$theme_id.'/img/footer.png',
							'send' => '/themes/'.$theme_id.'/img/send.png',
							'send_hover' => '/themes/'.$theme_id.'/img/send_hover.png',
							'label' => '/themes/'.$theme_id.'/img/label.png',
						  );
		$base_dir = 'wa-data/public/shop/plugins/recall/';
		
		$this->response = array('result'=>'ok', 'errors'=>$errors, 'files_updated' => $files_updated, 'basedir'=>$base_dir, 'img'=>$theme_img);
	}
	
	public function saveRoutingAction()
	{
		$routing = waRequest::post('rc_routing');
		$db = new waModel();
		$db->query("DELETE FROM shop_recall_routing");
		foreach($routing as $site=>$route)
		{
			foreach($route as $url=>$theme)
			$db->query("INSERT INTO shop_recall_routing (`domain`, `url`, `theme_id`) VALUES ('".$site."', '".$url."', '".$theme."')");
		}
		
		$this->response = array('result'=>'ok', 'routing'=>$routing);
	}
	
	public function addStatusAction()
	{
		$status_name = waRequest::post('status');
		$status_color = waRequest::post('color');
		
		$db = new waModel();
		
		$status_name = htmlspecialchars($status_name);
		$status_name = $db->escape($status_name);
		
		$status_color = substr($status_color, 0, 7);
		$status_color = htmlspecialchars($status_color);
		$status_color = $db->escape($status_color);
		
		$db->query("INSERT INTO shop_recall_status (`name`, `color`) VALUES ('".$status_name."', '".$status_color."')");
		
		$status_list = $db->query("SELECT * FROM shop_recall_status ORDER BY sort ASC")->fetchAll();
		
		$this->response = array('result'=>'ok', 'status' => $status_list);
	}
	
	public function renameStatusAction()
	{
		$status_id = intval(waRequest::post('status'));
		$status_color = waRequest::post('color');
		
		$db = new waModel();
		
		$status_name = waRequest::post('name');
		$status_name = htmlspecialchars($status_name);
		$status_name = $db->escape($status_name);
		
		$status_color = substr($status_color, 0, 7);
		$status_color = htmlspecialchars($status_color);
		$status_color = $db->escape($status_color);
		
		$db->query("UPDATE shop_recall_status SET `name`='".$status_name."', `color`='".$status_color."'  WHERE `id`=".$status_id);
		
		$status_list = $db->query("SELECT * FROM shop_recall_status")->fetchAll();
		
		$this->response = array('result'=>'ok', 'status' => $status_list);
	}
	
	public function removeStatusAction()
	{
		$status_id = intval(waRequest::post('status'));
		$new_status = 'NULL';
		if(waRequest::post('new_status')) 
		{
			$new_status = intval(waRequest::post('new_status'));
			if($new_status == -1) {$new_status = 'NULL';}
		}
		
		$db = new waModel();
		$count_requests = $db->query("UPDATE shop_recall_requests SET `status_code`=".$new_status." WHERE `status_code`=".$status_id)->affectedRows();
		$nname = 'Без статуса';
		$requests = null;
		if($new_status != 'NULL')
		{
			$db->query("UPDATE shop_recall_status SET `request_count`=`request_count`+".$count_requests." WHERE `id`=".$new_status);
			
			$new_status_name = $db->query("SELECT name FROM shop_recall_status WHERE id=".$new_status)->fetchAll();
			$nname = $new_status_name[0]['name'];
			if(!$nname) {$nname = 'Без статуса';}
			
			$requests = $db->query("SELECT id FROM shop_recall_requests WHERE status_code=".$new_status)->fetchAll();
		}
		
		if($requests)
		{
			foreach($requests as $key=>$value)
			{
				$db->query("INSERT INTO shop_recall_history (`request_id`, `user_id`, `comment`, `deploy_time`) 
						VALUES ('".$value['id']."', '".wa()->getUser()->getId()."', 'Перемещен в статус по удалению предыдущего: ".$db->escape($nname)."', NOW())");
			}
		}
		
		$db->query("DELETE FROM shop_recall_status WHERE `id`=".$status_id);
		
		$status_list = $db->query("SELECT * FROM shop_recall_status ORDER BY sort ASC")->fetchAll();
		
		$this->response = array('result'=>'ok', 'status' => $status_list);
	}
	
	
	public function saveStatusOrderAction()
	{
		$order = waRequest::post('order');
		
		foreach($order as $key=>$value)
		{
			$db = new waModel();
			$db->query("UPDATE shop_recall_status SET `sort`='".intval($value)."' WHERE `id`=".intval($key));
		}
		
		$this->response = array('result'=>'ok', 'order' => $order);
	}
	
	public function saveTextContentAction()
	{
		$text_content = waRequest::post('tc');
		foreach($text_content as $key=>$value)
		{
			$text_content[$key] = htmlspecialchars($value);
		}
		
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$recall_plugin->saveSettings($text_content);
		
		$this->response = array('result'=>'ok', 'text_content' => $text_content);
	}
	
	public function getRequestsAction()
	{
		$status_id = waRequest::post('status');
		$offset = intval(waRequest::post('offset'));
		$count = 20;
		
		$db = new waModel();
		
		$condition = "";
		if($status_id == 'e_new') {$condition = 'WHERE a.is_new IS NULL';}
		if($status_id != 'e_all' && $status_id != 'e_new')
		{
			if($status_id == 'off') {$status_id = 'IS NULL';}
			else {$status_id = '= '.intval($status_id);}
			$condition = 'WHERE a.status_code '.$status_id.' ';
		}
		
		$requests = $db->query("SELECT a.id, a.contact_id, a.product_id, a.referrer_name, a.referrer_phone, a.referrer_email, a.status_code, a.is_new, a.deploy_time,
								b.name AS status_name, b.color, 
								p.name AS product_name, 
								c.name AS contact_name
								FROM shop_recall_requests AS a
								LEFT JOIN shop_recall_status AS b
								ON a.status_code = b.id
								LEFT JOIN shop_product AS p
								ON a.product_id = p.id
								LEFT JOIN wa_contact AS c
								ON a.contact_id = c.id
								".$condition." 
								ORDER BY a.deploy_time DESC
								LIMIT ".$offset.",".$count)->fetchAll();
								
		$request_count = $db->query("SELECT count(id) AS total FROM shop_recall_requests AS a ".$condition)->fetchAll();
		
		foreach($requests as $key=>$request)
		{
			$requests[$key]['contact_name'] = htmlspecialchars($request['contact_name'], ENT_QUOTES);
			// ПАРАНОЙЯ
			$requests[$key]['product_name'] = htmlspecialchars($request['product_name'], ENT_QUOTES);
		}
		
		$this->response = array('result'=>'ok', 'requests' => $requests, 'status_id' => $status_id, 'total' => $request_count[0]['total']);
	}
	
	public function searchRequestsAction()
	{
		$query = waRequest::post('query');
		if(strlen($query) < 2) {$this->response = array('result'=>'ok', 'requests' => array(), 'total' => 0); return;}
		
		$offset = intval(waRequest::post('offset'));
		$count = 20;
		
		$db = new waModel();
		
		$query = $db->escape($query);
		
		$condition = "
			WHERE 
			(
				a.referrer_name LIKE '%".$query."%' OR 
				p.name LIKE '%".$query."%' OR 
				a.referrer_phone LIKE '%".$query."%' OR 
				a.referrer_email LIKE '%".$query."%' OR
				MATCH(a.request_text) AGAINST ('".$query."' IN BOOLEAN MODE) OR
				DATE_FORMAT(a.deploy_time, '%Y-%m-%d') LIKE '%".$query."%' 
			) 
		";
		
		$requests = $db->query("SELECT a.id, a.contact_id, a.product_id, a.referrer_name, a.referrer_phone, a.referrer_email, a.status_code, a.is_new, a.deploy_time,
								b.name AS status_name, b.color, 
								p.name AS product_name,
								c.name AS contact_name								
								FROM shop_recall_requests AS a
								LEFT JOIN shop_recall_status AS b
								ON a.status_code = b.id
								LEFT JOIN shop_product AS p
								ON a.product_id = p.id
								LEFT JOIN wa_contact AS c
								ON a.contact_id = c.id
								".$condition."
								ORDER BY a.deploy_time DESC
								LIMIT ".$offset.",".$count)->fetchAll();
		
		$request_count = $db->query("SELECT count(a.id) AS total FROM shop_recall_requests AS a 
									LEFT JOIN shop_recall_status AS b
									ON a.status_code = b.id
									LEFT JOIN shop_product AS p
									ON a.product_id = p.id".$condition)->fetchAll();
		
		foreach($requests as $key=>$request)
		{
			$requests[$key]['contact_name'] = htmlspecialchars($request['contact_name'], ENT_QUOTES);
			// ПАРАНОЙЯ
			$requests[$key]['product_name'] = htmlspecialchars($request['product_name'], ENT_QUOTES);
		}
		
		$this->response = array('result'=>'ok', 'requests' => $requests, 'total' => $request_count[0]['total']);
	}
	
	public function getOtherRequestsAction()
	{
		if(waRequest::post('user')=='null') 
		{
			$this->response = array('result'=>'ok', 'requests' => array(), 'total' => 0);
			return;
		}
		
		$user_id = intval(waRequest::post('user'));
		$request_id = intval(waRequest::post('request'));
		$offset = intval(waRequest::post('offset'));
		$count = 5;
		
		$db = new waModel();
		
		$requests = $db->query("SELECT a.id, a.product_id, 
								a.status_code, a.deploy_time, a.request_text,
								b.name AS status_name, b.color,
								p.name AS product_name 
								FROM shop_recall_requests AS a
								LEFT JOIN shop_recall_status AS b
								ON a.status_code = b.id
								LEFT JOIN shop_product AS p
								ON a.product_id = p.id
								WHERE a.contact_id=".$user_id." AND a.id !=".$request_id." ORDER BY a.deploy_time DESC LIMIT ".$offset.",".$count)->fetchAll();
		
		foreach($requests as $key=>$request)
		{
			// ПАРАНОЙЯ
			$requests[$key]['product_name'] = htmlspecialchars($request['product_name'], ENT_QUOTES);
		}
		
		$request_count = $db->query("SELECT count(id) AS total FROM shop_recall_requests AS a WHERE a.contact_id=".$user_id." AND a.id !=".$request_id)->fetchAll();
		
		$this->response = array('result'=>'ok', 'requests' => $requests, 'total' => $request_count[0]['total']);
	}
	
	public function changeRequestStatusAction()
	{
		$status_id = waRequest::post('status');
		if($status_id == 'off') {$status_id = ' NULL ';}
		else {$status_id = intval($status_id );}
		$request_id = intval(waRequest::post('request'));
		
		$db = new waModel();
		
		$old_status = $db->query("SELECT status_code FROM shop_recall_requests WHERE id=".$request_id)->fetchAll();
		if(count($old_status) > 0)
		{
			if($old_status[0]['status_code'])
			{
				$db->query("UPDATE shop_recall_status SET `request_count`=`request_count`-1 WHERE `id`=".$old_status[0]['status_code']);
			}
			$db->query("UPDATE shop_recall_status SET `request_count`=`request_count`+1 WHERE `id`=".$status_id);
			$db->query("UPDATE shop_recall_requests SET `status_code`=".$status_id." WHERE `id`=".$request_id);
			
			$status_list = $db->query("SELECT * FROM shop_recall_status")->fetchAll();
			
			$no_status = $db->query("SELECT count(id) AS request_count FROM shop_recall_requests WHERE status_code is NULL")->fetchAll();
			array_push($status_list, array('id' => 'off', 'name' => 'Без статуса', 'request_count' => $no_status[0]['request_count'], 'sort' => -1));
			
			$new_status_name = $db->query("SELECT name FROM shop_recall_status WHERE id=".$status_id)->fetchAll();
			
			$nname = $new_status_name[0]['name'];
			if(!$nname) {$nname = 'Без статуса';}
			$db->query("INSERT INTO shop_recall_history (`request_id`, `user_id`, `comment`, `deploy_time`) 
						VALUES ('".$request_id."', '".wa()->getUser()->getId()."', 'Перемещен в статус: ".$db->escape($nname)."', NOW())");
			
			$this->response = array('result'=>'ok', 'status' => $status_list, 'new_name' => $nname);
			return;
		}
		$this->response = array('result'=>'error', 'error' => 'Не найден целевой запрос.');
	}
	
	public function loadRequestAction()
	{
		$request_id = intval(waRequest::post('request'));
		
		$db = new waModel();
		
		$db->query("UPDATE shop_recall_requests SET `is_new`=1 WHERE `id`=".$request_id);
		
		$request_data = $db->query("SELECT a.id, a.contact_id, a.product_id, a.referrer_name, 
								a.referrer_phone, a.referrer_email, a.status_code, a.is_new, a.url, a.user_ip, a.deploy_time, a.request_text,
								b.name AS status_name,
								p.name AS product_name,
								c.name AS contact_name
								FROM shop_recall_requests AS a
								LEFT JOIN shop_recall_status AS b
								ON a.status_code = b.id
								LEFT JOIN shop_product AS p
								ON a.product_id = p.id
								LEFT JOIN wa_contact AS c
								ON a.contact_id = c.id
								WHERE a.id=".$request_id)->fetchAll();
		if(count($request_data) == 0)
		{
			$this->response = array('result'=>'error', 'error' => 'Не найден целевой запрос №'.$request_id.'.'); return;
		}
		
		$new_requests = $db->query("SELECT count(id) AS total_count FROM shop_recall_requests WHERE is_new IS NULL")->fetchAll();
		
		$request_data[0]['contact_name'] = htmlspecialchars($request_data[0]['contact_name'], ENT_QUOTES);
		$request_data[0]['product_name'] = htmlspecialchars($request_data[0]['product_name'], ENT_QUOTES);
		
		$this->response = array('result'=>'ok', 'request' => $request_data[0], 'new_requests' => $new_requests[0]['total_count'], 'backend_url' => substr(wa()->getRootUrl(true, true), 0, -1).wa()->getAppUrl('shop').'?plugin=recall&module=backend&action=control&rc_onload='.$request_id);
	}
	
	public function loadRequestHistoryAction()
	{
		$request_id = intval(waRequest::post('request'));
		$db = new waModel();
		
		$create_time = $db->query("SELECT a.deploy_time, a.contact_id, a.referrer_name
									FROM shop_recall_requests AS a
									WHERE a.id=".$request_id)->fetchAll();
		if(count($create_time) > 0)
		{
			$history = $db->query("SELECT a.user_id, a.comment, a.deploy_time, b.referrer_name, c.name AS contact_name  
									FROM shop_recall_history AS a
									LEFT JOIN shop_recall_requests AS b
									ON a.request_id = b.id
									LEFT JOIN wa_contact AS c
									ON a.user_id = c.id
									WHERE a.request_id=".$request_id." ORDER BY a.deploy_time DESC")->fetchAll();
			
			
			foreach($history as $key=>$item)
			{
				$history[$key]['contact_name'] = htmlspecialchars($item['contact_name'], ENT_QUOTES);
			}
		
			array_push($history, array('user_id' => $create_time[0]['contact_id'], 'comment'=>'Запрос создан', 'deploy_time' => $create_time[0]['deploy_time'], 'referrer_name'=>$create_time[0]['referrer_name'], 'contact_name'=>$create_time[0]['referrer_name']));
			$this->response = array('result'=>'ok', 'history' => $history);
		}
		else {$this->response = array('result'=>'ok', 'history' => array());}
	}
	
	public function addCommentAction()
	{
		$request_id = intval(waRequest::post('request'));
		$comment = waRequest::post('comment');
		$db = new waModel();
		
		$comment = htmlspecialchars($comment);
		$comment = $db->escape($comment);
		
		$db->query("INSERT INTO shop_recall_history (`request_id`, `user_id`, `comment`, `deploy_time`) 
						VALUES ('".$request_id."', '".wa()->getUser()->getId()."', 'Добавлен комментарий: ".$comment."', NOW())");
		
		$this->response = array('result'=>'ok');
	}
	
	public function removeRequestAction()
	{
		$request_id = intval(waRequest::post('request'));
		$db = new waModel();
		
		$old_status = $db->query("SELECT status_code FROM shop_recall_requests WHERE id=".$request_id)->fetchAll();
		if(count($old_status) > 0)
		{
			if($old_status[0]['status_code'])
			{
				$db->query("UPDATE shop_recall_status SET `request_count`=`request_count`-1 WHERE `id`=".$old_status[0]['status_code']);
			}
		}
		$db->query("DELETE FROM shop_recall_requests WHERE `id`=".$request_id);
		
		$status_list = $db->query("SELECT * FROM shop_recall_status")->fetchAll();
			
		$no_status = $db->query("SELECT count(id) AS request_count FROM shop_recall_requests WHERE status_code is NULL")->fetchAll();
		array_push($status_list, array('id' => 'off', 'name' => 'Без статуса', 'request_count' => $no_status[0]['request_count'], 'sort' => -1));
			
		$this->response = array('result'=>'ok', 'status' => $status_list);
	}
	
	public function getExtraFieldsAction()
	{
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$result = $recall_plugin->getFields();
		
		$this->response = array('result'=>'ok', 'fields' => $result);
	}
	
	public function saveExtraFieldsAction()
	{
		$fields = waRequest::post('fields');
		$db = new waModel();
		$db->query("DELETE FROM shop_recall_field");
		$db->query("DELETE FROM shop_recall_field_values");
		foreach($fields as $key=>$value)
		{
			if(!isset($value['name']) || !isset($value['type'])) {unset($fields[$key]);}
			else
			{
				$fields[$key]['name'] = $db->escape(htmlspecialchars($value['name']));
				$fields[$key]['type'] = $db->escape(htmlspecialchars($value['type']));
				if(isset($value['visible'])) {$fields[$key]['visible'] = 1;}
				else {$fields[$key]['visible'] = 0;}
				if(isset($value['must_be'])) {$fields[$key]['must_be'] = 1;}
				else {$fields[$key]['must_be'] = 0;}
				$new_id = $db->query("INSERT INTO shop_recall_field (`name`, `visible`, `must_be`, `type`) 
						VALUES ('".$fields[$key]['name']."', '".$fields[$key]['visible']."', '".$fields[$key]['must_be']."', '".$fields[$key]['type']."')")->lastInsertId();
				if(isset($value['values']))
				{
					foreach($value['values'] as $ikey=>$ivalue)
					{
						$ivalue = $db->escape(htmlspecialchars($ivalue));
						$db->query("INSERT INTO shop_recall_field_values (`name`, `field_id`) 
										VALUES ('".$ivalue."', '".$new_id."')");
					}
				}
			}
		}
		
		$this->response = array('result'=>'ok', 'fields' => $fields);
	}
	
	public function getRequestExtraFieldsAction()
	{
		$request_id = intval(waRequest::post('request'));
		$db = new waModel();
		
		$fields = $db->query("SELECT * FROM shop_recall_request_extra WHERE request_id=".$request_id)->fetchAll();
		
		$this->response = array('result'=>'ok', 'fields' => $fields);
	}
	
	public function setRequestNewAction()
	{
		$request_id = intval(waRequest::post('request'));
		$db = new waModel();
		if($request_id) {$db->query("UPDATE shop_recall_requests SET `is_new`=NULL WHERE `id`=".$request_id);}
		$this->response = array('result'=>'ok');
	}
}