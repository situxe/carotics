<?php

class shopYoucityPluginBackendSearchyoucityController extends waJsonController
{
    public function execute()
    {
        mb_internal_encoding("UTF-8");
        $query = waRequest::post('query');
        $country = waRequest::post('country');
        $query = $this->mb_ucfirst($query);
        $youcity = new shopYoucityPluginHelper;
        $search = $youcity->getCitySearch($query);
        
        if($search)
        {
          $model = new waModel();  
          foreach($search as $key => $s)
          {
            if($country == $s[4] || !$country)
            {
                $search[$key][5] = $model->query("SELECT name FROM wa_region WHERE country_iso3 = '".$s[4]."' AND code = '".$s[2]."'")->fetchField();
                
                if(!$search[$key][5])
                {
                    $search[$key][5] = '';
                }
                else
                {
                    $search[$key][5] .= ' ';
                }
                
                switch($s[4]){
                    case 'rus': $search[$key][6] = 'Российская Федерация'; break;
                    case 'ukr': $search[$key][6] = 'Украина'; break;
                    case 'kaz': $search[$key][6] = 'Казахстан'; break;
                    case 'blr': $search[$key][6] = 'Белоруссия'; break;
                }
            }
            else
            {
                unset($search[$key]);
            } 
           }
         }
         else
         {
            $search = 'fail';
         }
        $this->response['search'] = $search;  
    }
    
    private function mb_ucfirst($text) 
    {
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }
}