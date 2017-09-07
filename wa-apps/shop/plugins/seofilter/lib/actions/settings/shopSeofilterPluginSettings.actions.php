<?php

class shopSeofilterPluginSettingsActions extends waJsonActions
{
	public function resetJsAction()
	{
		$appSettingsModel = new waAppSettingsModel();
		$appSettingsModel->set(array('shop', 'seofilter'), "js", '');
	}
}