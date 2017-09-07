<?php

class shopYoucityPluginBackendDeleteyoucityController extends waJsonController
{
    public function execute()
    {
        $id = waRequest::post('id');
        $model = new waModel(); 
                            
        if($id)
        {
            $model->query("DELETE FROM shop_youcity_cities WHERE id='{$id}'");
            $message = 'ok'; 
        }
        else
        {              
            $message = 'fail';               
        }                    
        
        $this->response['message'] = $message;  
    }
}