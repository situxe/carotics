<?php
class shopRecallPluginBackendControlAction extends waViewAction
{
    public function execute()
	{
		$this->setLayout(new shopBackendLayout());
		
		$recall_plugin = waSystem::getInstance('shop')->getPlugin('recall');
		$this->getResponse()->setTitle($recall_plugin->getSettings('tab_name'));
		
		$view = wa()->getView();
		
		$db = new waModel();
		
		$total_requests = $db->query("SELECT count(id) AS total_count FROM shop_recall_requests")->fetchAll();
		$view->assign('rc_total_requests', $total_requests[0]['total_count']);
		
		$new_requests = $db->query("SELECT count(id) AS total_count FROM shop_recall_requests WHERE is_new IS NULL")->fetchAll();
		$view->assign('rc_new_requests', $new_requests[0]['total_count']);
		
		$no_status = $db->query("SELECT count(id) AS total_count FROM shop_recall_requests WHERE status_code is NULL")->fetchAll();
		$view->assign('rc_no_status', $no_status[0]['total_count']);
		
		$status_list = $db->query("SELECT * FROM shop_recall_status ORDER BY sort ASC")->fetchAll();
		$view->assign('rc_status_list', $status_list);
		
		$set_onload = waRequest::get('rc_onload');
		if($set_onload) {$view->assign('rc_set_onload', $set_onload);}
		else {$view->assign('rc_set_onload', null);}
	}
}