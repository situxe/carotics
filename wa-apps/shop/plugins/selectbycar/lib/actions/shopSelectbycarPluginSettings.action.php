<?php

class shopSelectbycarPluginSettingsAction extends waViewAction {

    public function execute() {
        $this->view->assign('settings', wa()->getPlugin('selectbycar')->getSettings());
    }

}
