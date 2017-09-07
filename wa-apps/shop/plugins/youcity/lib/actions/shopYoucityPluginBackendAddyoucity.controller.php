<?php

class shopYoucityPluginBackendAddyoucityController extends waJsonController
{
    public function execute()
    {
        $city = waRequest::post('city');
        $country = waRequest::post('country');
        $region = waRequest::post('region');
        
        $model = new waModel(); 
        
        $id = $model->query("SELECT id FROM shop_youcity_cities WHERE city='{$city}' 
                            AND country='{$country}'
                            AND region='{$region}'")->fetchField();
                            
        if($id)
        {
            $message = 'isset';
        }
        else
        {
            $result = $model->query("INSERT INTO shop_youcity_cities (city, country, region) 
                           VALUES ('{$city}', '{$country}', '{$region}')");
            $this->response['id'] = $result->lastInsertId();               
            $message = 'ok';               
        }                    
        
        $this->response['message'] = $message;  
    }
}