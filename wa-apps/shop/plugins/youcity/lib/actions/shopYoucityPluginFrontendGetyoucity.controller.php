<?php

class shopYoucityPluginFrontendGetyoucityController extends waJsonController
{
    public function execute()
    {
        $youcity = new shopYoucityPluginHelper;
        $data = $youcity->getRecord(waRequest::getIp());
        
        if(!$data['city'])
        {
            $plugin_id = array('shop', 'youcity');
            $sett = new waAppSettingsModel();
            $data['cc'] = $sett->get($plugin_id, 'default_country');
            $data['region'] = $sett->get($plugin_id, 'default_region');
            $data['city'] = $sett->get($plugin_id, 'default_city');
        }
        $this->response['country'] = $data['cc'];
        $this->response['region'] = $data['region'];
        $this->response['city'] = $data['city'];  
    }
}