<?php

class shopYoucityPluginSettingsSaveController extends waJsonController {
    
    public function execute()
    {
        $plugin_id = array('shop', 'youcity');
        
        try {
            $app_settings_model = new waAppSettingsModel();
            $youcity = waRequest::post('settings');
            $reset_tpls = waRequest::post('reset_tpls');
            $template= waRequest::post('template');
            
            if (isset($reset_tpls)) {
                $template_path = wa()->getDataPath('plugins/youcity/templates/ViewCity.html', false, 'shop', true);
                @unlink($template_path);
            } else {

                if (!isset($template)) {
                    throw new waException('Не определён шаблон');
                }
                $template_path = wa()->getDataPath('plugins/youcity/templates/ViewCity.html', false, 'shop', true);
                if (!file_exists($template_path)) {
                    $template_path = wa()->getAppPath('plugins/youcity/templates/ViewCity.html', 'shop');
                }

                $template_content = file_get_contents($template_path);
                if ($template_content != $template) {
                    $template_path = wa()->getDataPath('plugins/youcity/templates/ViewCity.html', false, 'shop', true);

                    $f = fopen($template_path, 'w');
                    if (!$f) {
                        throw new waException('Не удаётся сохранить шаблон. Проверьте права на запись ' . $template_path);
                    }
                    fwrite($f, $template);
                    fclose($f);
                }
            }
            
            if(isset($youcity['windows']))
            {
                $app_settings_model->set($plugin_id, 'windows', '1');
            } else {
               $app_settings_model->set($plugin_id, 'windows', '0'); 
            }
            
            $country = array('rus','ukr','kaz','blr');
            foreach($country as $c)
            {
                if(isset($youcity[$c]))
                {
                    $app_settings_model->set($plugin_id, $c, '1');
                } else {
                    $app_settings_model->set($plugin_id, $c, '0');
                }
            }
            
            if($youcity['default_city'] == '')
            {
                $youcity['default_city'] = 'Москва';
                $youcity['default_country'] = 'rus';
                $youcity['default_region'] = 77;
            }
            
            $app_settings_model->set($plugin_id, 'status', (int) $youcity['status']);
            $app_settings_model->set($plugin_id, 'default_region', (int) $youcity['default_region']);
            $app_settings_model->set($plugin_id, 'default_country', $youcity['default_country']);
            $app_settings_model->set($plugin_id, 'default_city', $youcity['default_city']);
            $app_settings_model->set($plugin_id, 'link', $youcity['link']);
            
            $this->response['message'] = "Сохранено";
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }
}