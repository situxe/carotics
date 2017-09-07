<?php

class shopSelectbycarPlugin extends shopPlugin {

    public function frontendHeader() {
        if (wa()->getPlugin('selectbycar')->getSettings('frontend_header')) {
            return self::display();
        }
    }

    public static function display() {
        if(!wa()->getPlugin('selectbycar')->getSettings('status')) {
            return;
        }
        $template_path = wa()->getAppPath('plugins/selectbycar/templates/Selectbycar.html', 'shop');
        $view = wa()->getView();
        $view->assign('category_id', wa()->getPlugin('selectbycar')->getSettings('category_id'));
        $html = $view->fetch($template_path);
        return $html;
    }

}
