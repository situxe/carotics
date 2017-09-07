<?php

class shopEdostPluginSettingsAction extends waViewAction {

    public function execute() {
        $this->view->assign('settings', wa()->getPlugin('edost')->getSettings());
    }

}
