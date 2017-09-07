<?php 

class shopYoucityPlugin extends shopPlugin
{
    private function status()
    {
        $plugin_id = array('shop', 'youcity');
        $sett = new waAppSettingsModel();
        $status = $sett->get($plugin_id, 'status');
        if (!$status) 
        {return false;}
        else{return true;}
    }

    public function frontendHeader()
    {
       if (!self::status()) {return;}
       
       $model = new waModel();
       $plugin_id = array('shop', 'youcity');
       $sett = new waAppSettingsModel();
        
       $data = $model->query("SELECT * FROM shop_youcity_cities")->fetchAll();
       if($data)
       {
          $country = array('rus','ukr','kaz','blr');
          foreach($country as $c)
          {
              $st = $sett->get($plugin_id, $c);
              if($st)
              {
                $co[] = $c;
                $info[$c] = array();
              }   
          }
          foreach($data as $d)
          {
            if(is_array($info[$d['country']]))
            {
                $info[$d['country']][$d['id']]['city'] = $d['city'];
                $info[$d['country']][$d['id']]['region'] = $d['region'];
            } 
          }
       }

       
       $view = wa()->getView();
       $view->assign('info', $info);
       $view->assign('country', $co);
       $content = $view->fetch($this->path.'/templates/YoucityWindow.html');  
       $content .= $view->fetch($this->path.'/templates/YoucityAsk.html');     
       return $content;  
    }
    
    public function frontendHead()
    {
        if (!self::status()) {return;}
        $plugin_id = array('shop', 'youcity');
        $sett = new waAppSettingsModel();
        $windows = $sett->get($plugin_id, 'windows');
        
        $url = wa()->getRouteUrl('shop/frontend/Getyoucity');
        $searchUrl = wa()->getRouteUrl('shop/frontend/Searchyoucity');    
      
      return "<script>$(function() { 
        $.youcityWindows = '".$windows."';
        $.youcitySearchUrl = '".$searchUrl."';
        $.youcityPluginUrl = '".$url."';});</script>
        <script src='" . wa()->getAppStaticUrl('shop') . "plugins/youcity/js/youcity.js?".date('His')."'></script>
        <link rel='stylesheet' href='" . wa()->getAppStaticUrl('shop') . "plugins/youcity/css/youcity.css?".date('His')."'>";
    }
    
    static public function getViewCity()
    {   
        if (!self::status()) {return;}
        
        $template_path = wa()->getDataPath('plugins/youcity/templates/ViewCity.html', false, 'shop', true);
        if (!file_exists($template_path)) 
        {
            $template_path = wa()->getAppPath('plugins/youcity/templates/ViewCity.html', 'shop');
        }
        
        $view = wa()->getView();
        $link = $view->fetch($template_path);
        
        return $link;
    }

}
