<?php

class shopOnestepPluginFrontendOnestepCartAction extends shopFrontendCartAction {

    public function execute() {
        $plugin = wa()->getPlugin('onestep');
        if (!$plugin->getSettings('status')) {
            throw new waException(_ws("Page not found"), 404);
        }
        if (shopOnestepHelper::getRouteSettings(null, 'status')) {
            $route_hash = null;
            $route_settings = shopOnestepHelper::getRouteSettings();
        } elseif (shopOnestepHelper::getRouteSettings(0, 'status')) {
            $route_hash = 0;
            $route_settings = shopOnestepHelper::getRouteSettings(0);
        } else {
            throw new waException(_ws("Page not found"), 404);
        }
        
        $CheckoutContactinfo = new shopOnestepCheckoutContactinfo();
        $CheckoutContactinfo->updateContact();

        parent::execute();

        $onestep_template = shopOnestepHelper::getRouteTemplates($route_hash, 'onestepCart', false);

        $this->view->assign('settings', $route_settings);
        waSystem::popActivePlugin();
        
        $html = $this->view->fetch($onestep_template['template_path']);

        $this->getResponse()->setTitle($route_settings['page_title']);
        $this->view->assign('page', array(
            'id' => 'onestepcart',
            'title' => $route_settings['page_title'],
            'name' => $route_settings['page_title'],
            'content' => $html,
        ));
        $this->setThemeTemplate($route_settings['page_template']);
    }

}
