<?php

class shopEdostPluginFrontendEdostAction extends shopFrontendAction {

    public function execute() {
        $sku_id = waRequest::get('sku_id');
        $sku_model = new shopProductSkusModel();
        $sku = $sku_model->getById($sku_id);
        $product_model = new shopProductModel();
        $product = $product_model->getById($sku['product_id']);
        $edost_plugins = wa()->getPlugin('edost');
        
        $address = $this->getAddress();
                    
        $item = array (
            'id' => $product['id'],
            'sku_id' => $sku_id,
            'quantity' => 1,
            'currency' => $product['currency'],
            'price' => $sku['price'],
         );
        
        if ($edost_plugins->getSettings('status')) {
            $plugin_model = new shopPluginModel();
            $methods = $plugin_model->listPlugins('shipping');
            foreach ($methods as $m) {
                if ($m['plugin'] == 'edost') {
                    $plugin = shopShipping::getPlugin('edost', $m['id']);

                    
                    $plugin->calculate('order', $address, array($item));
                }
            }
        }
        $shipping = new shopCheckoutShipping();
        $shipping->display();
        $checkout_shipping_methods = $this->view->getVars('checkout_shipping_methods');
        foreach($checkout_shipping_methods as $index => &$checkout_shipping_method) {
            if($checkout_shipping_method['plugin'] != 'edost' && $checkout_shipping_method['plugin'] != 'tkkit') {
                unset($checkout_shipping_methods[$index]);
            }
            if($checkout_shipping_method['plugin'] == 'tkkit'){
                $plugin = shopShipping::getPlugin('tkkit', $checkout_shipping_method['id']);
                $rates = $plugin->calculate($address);
                if(is_array($rates)) {
                    $checkout_shipping_method['rates'] = $rates;
                } else {
                   $checkout_shipping_method['rates'] = array(
                    array('rate' => null, 'comment' => $rates),
                   ); 
                }                
            }
        }     
        unset($checkout_shipping_method);   
        //print_r($checkout_shipping_methods);
        $this->view->assign('checkout_shipping_methods', $checkout_shipping_methods);
    }

    protected function getAddress() {
        if (waRequest::cookie('Youcity')) {
            $data = array(
                'region' => waRequest::cookie('Youregion'),
                'city' => waRequest::cookie('Youcity'),
                'country' => waRequest::cookie('Youcountry'),
            );
        } else {
            if(!class_exists('shopYoucityPluginHelper')) {
                throw new waException('Отсутствует класс shopYoucityPluginHelper');
            }
            $youcity = new shopYoucityPluginHelper;
            $data = $youcity->getRecord(waRequest::getIp());

            if (!$data['city']) {
                $plugin_id = array('shop', 'youcity');
                $sett = new waAppSettingsModel();
                $data['cc'] = $sett->get($plugin_id, 'default_country');
                $data['region'] = $sett->get($plugin_id, 'default_region');
                $data['city'] = $sett->get($plugin_id, 'default_city');
            }
            $data['country'] = $data['cc'];
        }
        return $data;
    }

}
