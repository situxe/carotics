<?php

class shopRecallPluginSettingsAction extends waViewAction
{
    public function execute()
    {
        $view = wa()->getView();
		$db = new waModel();
		
		// Получение текстового контента
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$recall_settings = $recall_plugin->getSettings();
		
		$view->assign('rc_sys_settings', $recall_settings);
		
		// Получение данных о статусах заказов
		$status = $db->query("SELECT * FROM shop_recall_status ORDER BY sort ASC")->fetchAll();
		$view->assign('rc_status', $status);
		
		// Загрузка данных маршрутизации
		// Системная маршрутизация
		$routing = require_once dirname(__FILE__).'/../../../../../../wa-config/routing.php';
		// Маршрутизация Recall
		$recall_routes = $db->query("SELECT * FROM shop_recall_routing ORDER BY id ASC")->fetchAll();
		// Сравнение маршрутизаций
		foreach($routing as $site => $route_data)
		{
			if(is_array($route_data))
			{
				foreach($route_data as $route_key=>$wa_route)
				{
					foreach($recall_routes as $rc_key=>$rc_route)
					{
						if($rc_route['domain'] == $site && $rc_route['url'] == $wa_route['url'])
						{
							$routing[$site][$route_key]['rc_theme'] = $rc_route['theme_id'];
							break;
						}
					}
				}
			}
			else {unset($routing[$site]);}
		}
		
		$view->assign('rc_routing', $routing);
		
		// Получение данных тем дизайна
		$themes_list = require_once dirname(__FILE__).'/../../themes/themes.php';
		$themes = array();
		foreach($themes_list as $theme_id => $theme_name)
		{
			$current_theme = array(
									'id' => $theme_id,
									'name' => $theme_name,
									'cover' => '/themes/'.$theme_id.'/cover.png',
								  );
			array_push($themes, $current_theme);
		}
		$view->assign('rc_themes', $themes);
    }
}
