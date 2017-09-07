<?php
class shopRecallPlugin extends shopPlugin
{
	static public function getStaticOutput()
	{
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
               
                return $recall_plugin->frontendHeader(true);
	}

	public function frontendHeader($from_other_app = null)
	{
		$host = waRequest::server('HTTP_HOST');
		$uri = waRequest::server('REQUEST_URI');
		
		$view = wa()->getView();
		
		// Маршрутизация
		$shop_url = "";
		$routing = require dirname(__FILE__).'/../../../../../wa-config/routing.php';
		$config = require dirname(__FILE__).'/../../../../../wa-config/config.php';
		$rewrite_modificator = "/";
		if($config['mod_rewrite'] == '0') {$rewrite_modificator = '/index.php/';}
		
		$domain_alias = array();
		foreach($routing as $site => $route_data)
		{
			if(!is_array($route_data))
			{
				if(isset($routing[$route_data])) 
				{
					$domain_alias[$site] = $route_data;
					$routing[$site] = $routing[$route_data];
				}
				else {unset($routing[$site]);}
			}
		}
		
		foreach($routing as $site => $route_data)
		{
			foreach($route_data as $route)
			{
				if($route['app'] == 'shop')
				{
					$check_route = $site.$rewrite_modificator.str_replace("*", "", $route['url']);
					if($from_other_app) 
					{
						$real_route = $host;
						if(strncasecmp($check_route, $real_route, strlen($real_route)) == 0)
						{
							$shop_url = str_replace("*", "", $check_route); break;
						}
					}
					else
					{
						$real_route = $host.$uri;
						if(strncasecmp($check_route, $real_route, strlen($check_route)) == 0)
						{
							$shop_url = str_replace("*", "", $check_route); break;
						}
					}
				}
			}
		}
		
		// Ссылка на экшен
		// Очень хотелось бы использовать wa()->getRouteUrl('shop/frontend/sendrequest', array('domain' => $host, 'plugin' => 'recall'), true);
		// Но интересно получается - если мы работаем на алиасе домена, то getRouteUrl в режиме абсолютной ссылки, даже если указать домен явно, 
		// да и вообще в любом случае, вернет ссылку на основной домен, а не на алиас. Происходит это только в случае, когда плагин работает из
		// приложения "магазин" - из блога, почему-то, даже без флага absolute = true при передаче параметра domain выдает корректный абсолютный урл.
		// Пример - routing.php: 'test2.example.com' => 'test.example.com', на test2.example.com getRouteUrl будет выдавать http://test.example.com/
		// $rc_route_url = wa()->getRouteUrl('shop/frontend/sendrequest', array('domain' => $host, 'plugin' => 'recall'), true);
		
		$rc_route_url = '//'.$shop_url;
		$view->assign('rc_route_url', $rc_route_url.'recallrequest/');
		
		if(strlen($shop_url) == 0) {$rc_theme = 'off';}
		else 
		{
			if(isset($domain_alias[$host])) {$rc_theme = $this->getFrontendTheme($domain_alias[$host], $uri, $rewrite_modificator);}
			else {$rc_theme = $this->getFrontendTheme($host, $uri, $rewrite_modificator);}
		}
		
		$view->assign('rc_theme_id', $rc_theme);
		
		if($rc_theme != 'off')
		{
			// Поиск пути до темы оформления
			$theme_path = dirname(__FILE__).'/../themes/'.$rc_theme;
			if($this->themeHasCopy($rc_theme)) 
			{
				$view->assign('rc_theme_path', 'wa-data/public/shop/plugins/recall/themes/');
				$theme_path = dirname(__FILE__).'/../../../../../wa-data/public/shop/plugins/recall/themes/'.$rc_theme;
			}
			else {$view->assign('rc_theme_path', 'wa-apps/shop/plugins/recall/themes/');}
			
			// Загрузка настроек темы оформления
			$theme_settings = file_get_contents($theme_path.'/settings.cfg');
			$theme_settings = $this->parseConfig($theme_settings);
			// Если настройки попорчены, используем стандарт
			if(!isset($theme_settings['itype'])) {$theme_settings['itype'] = 'label';}
			if(!isset($theme_settings['hook'])) {$theme_settings['hook'] = 'recall_popup';}
			if($theme_settings['itype'] == 'label') {$theme_settings['hook'] = 'recall_deploy_window';}
			// Передача в шаблон
			$view->assign('rc_theme_settings', $theme_settings);
			
			// Загрузка дополнительных полей
			$view->assign('rc_fields', $this->getFields());
		}
		
		// Системные настройки
		$sys_settings = $this->getSettings();
		$view->assign('rc_sys_settings', $sys_settings);
		
		// Пользователь
		$user_id = wa()->getUser()->getId();
		if($user_id)
		{
			$user_data = new waContact($user_id);
			$view->assign('rc_user_name', $user_data->getName());
			$view->assign('rc_user_email', $user_data->get('email', 'default'));
			$view->assign('rc_user_phone', $user_data->get('phone', 'html'));
			$view->assign('rc_user_id', $user_id);
		}
		else {$view->assign('rc_user_id', -1);}
		
		return $view->fetch(wa()->getAppPath(null, 'shop').'/plugins/recall/templates/frontendHeader.html');
	}
	
	public function backendMenu()
	{
		$tab_class = 'no-tab';
		if(waRequest::get('action') && waRequest::get('plugin')) 
		{
			if(waRequest::get('action') == 'control' && waRequest::get('plugin') == 'recall') {$tab_class = 'selected';}
		}
		
		$unread_count = $this->getUnreadCount();
		$unread_html = '';
		if($unread_count > 0 && $tab_class == 'no-tab') {$unread_html = '<sup class="red" style="display:inline">'.$unread_count.'</sup>';}
		
		$html = '<li class="'.$tab_class.'">
					<a href="?plugin=recall&module=backend&action=control">'.$this->getSettings('tab_name').$unread_html.'</a>
				</li>';
		
		return array('core_li' => $html);
	}
	
	public function frontendProduct($Params)
	{
		if($this->getSettings('askaboutproduct'))
		{
			$host = waRequest::server('HTTP_HOST');
			$uri = waRequest::server('REQUEST_URI');
			
			$config = require dirname(__FILE__).'/../../../../../wa-config/config.php';
			$rewrite_modificator = "/";
			if($config['mod_rewrite'] == '0') {$rewrite_modificator = '/index.php/';}
			
			$rc_theme = $this->getFrontendTheme($host, $uri, $rewrite_modificator);
			if($rc_theme != 'off') 
			{
				$aux_html = '<div class="recall_ask_about_the_product" data-pid="'.$Params['id'].'">'.$this->getSettings('askaboutproducttext').'</div>';
				return array('block_aux' => $aux_html);
			}
			else {return array('block_aux'=>'');}
		}
		else {return array('block_aux'=>'');}
	}
	
	public function getFrontendTheme($host, $uri, $rewrite_modificator)
	{
		// Поиск темы оформления
		$db = new waModel();
		$recall_routes = $db->query("SELECT * FROM shop_recall_routing ORDER BY id ASC");
		$rc_theme = 'off';
		if(count($recall_routes))
		{
			foreach($recall_routes as $rc_key=>$rc_route)
			{
				$check_route = $rc_route['domain'].$rewrite_modificator.str_replace ("*", "", $rc_route['url']);
				$real_route = $host.$uri;
				if(strncasecmp($check_route, $real_route, strlen($check_route)) == 0)
				{
					$rc_theme = $rc_route['theme_id'];
					break;
				}
			}
		}
		return $rc_theme;
	}
	
	public function createConfig($data)
	{
		$result = "";
		foreach($data as $key=>$value)
		{
			if(strlen($result)>0) {$result.=",";}
			$result .= $key."=>".$value;
		}
		return $result;
	}
	
	public function parseConfig($config)
	{
		$result = array();
		$params = explode(",",$config);
		foreach($params as $param)
		{
			$data = explode("=>",$param);
			if(count($data)==2){$result[$data[0]] = $data[1];}
		}
		return $result;
	}
	
	public function getFields()
	{
		$db = new waModel();
		$result = $db->query("SELECT * FROM shop_recall_field")->fetchAll();
		foreach($result as $key=>$value)
		{
			if($value['type'] == 'select' || $value['type'] == 'checkbox')
			{
				$result[$key]['values'] = array();
				$field_values = $db->query("SELECT * FROM shop_recall_field_values WHERE field_id=".$value['id'])->fetchAll();
				if(count($field_values)>0)
				{
					foreach($field_values as $fkey=>$fvalue)
					{
						array_push($result[$key]['values'], array('id' => $fvalue['id'], 'name' => $fvalue['name']));
					}
				}
			}
		}
		return $result;
	}
	
	public function getRequiredFields()
	{
		$db = new waModel();
		$result = $db->query("SELECT id, name FROM shop_recall_field WHERE visible=1 AND must_be=1")->fetchAll();
		return $result;
	}
	
	public function themeHasCopy($theme_id)
	{
		$copy_path = dirname(__FILE__).'/../../../../../wa-data/public/shop/plugins/recall/themes/'.$theme_id.'/';
		if(is_dir($copy_path)) {return 1;}
		else {return 0;}
	}
	
	public function createThemeCopy($theme_id)
	{
		$repo_path = dirname(__FILE__).'/../themes/';
		$copy_path = dirname(__FILE__).'/../../../../../wa-data/public/shop/plugins/recall/themes/';
		waFiles::copy($repo_path.$theme_id.'/', $copy_path.$theme_id.'/'); 
		
		if(is_dir($copy_path.$theme_id.'/')){return 1;}
		else {return 0;}
	}
	
	public function getUnreadCount()
	{
		$db = new waModel();
		return $db->query("SELECT is_new FROM shop_recall_requests WHERE is_new IS NULL")->count();
	}
}