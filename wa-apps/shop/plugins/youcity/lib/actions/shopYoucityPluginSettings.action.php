<?php

class shopYoucityPluginSettingsAction extends waViewAction
{
    
    public function execute()
    {
        $model_settings = new waAppSettingsModel();
        $settings = $model_settings->get($key = array('shop', 'youcity')); 
        
        $template_path = wa()->getDataPath('plugins/youcity/templates/ViewCity.html', false, 'shop', true);
        $change_tpl = true;
        if (!file_exists($template_path)) 
        {
            $template_path = wa()->getAppPath('plugins/youcity/templates/ViewCity.html', 'shop');
            $change_tpl = false;
        }
        
        $template_content = file_get_contents($template_path);
        
        $model = new waModel();
        $data = $model->query("SELECT * FROM shop_youcity_cities")->fetchAll();
        
        $country = array('rus','ukr','kaz','blr');
        foreach($country as $c)
        {
            $info[$c] = array();   
        }
        foreach($data as $d)
        {
            $info[$d['country']][$d['id']] = $d['city'];
        }
        
        $this->view->assign('info', $info);
        $this->view->assign('change_tpl', $change_tpl);
        $this->view->assign('template', $template_content);
        $this->view->assign('settings', $settings);
    }       
}
