<?php

class shopEdostPlugin extends shopPlugin {

    public function frontendProduct($product) {
        if ($this->getSettings('status') && $this->getSettings('frontend_product_output')) {
            return array($this->getSettings('frontend_product_output') => self::display());
        }
    }

    public static function display() {
        $plugin = wa()->getPlugin('edost');
        if ($plugin->getSettings('status')) {
            $plugin_model = new shopPluginModel();
            $methods = $plugin_model->listPlugins('shipping');
            foreach ($methods as $m) {
                if ($m['plugin'] == 'edost') {
                    $view = wa()->getView();
                    $template_path = wa()->getAppPath('plugins/edost/templates/FrontendProduct.html', 'shop');
                    $html = $view->fetch($template_path);
                    return $html;
                }
            }
        }
    }

}
