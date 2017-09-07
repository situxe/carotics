<?php
$plugin_id = array('shop', 'youcity');
$app_settings_model = new waAppSettingsModel();
$app_settings_model->set($plugin_id, 'status', '1');
$app_settings_model->set($plugin_id, 'windows', '1');
$app_settings_model->set($plugin_id, 'rus', '0');
$app_settings_model->set($plugin_id, 'ukr', '0');
$app_settings_model->set($plugin_id, 'kaz', '0');
$app_settings_model->set($plugin_id, 'blr', '0');
$app_settings_model->set($plugin_id, 'default_city', 'Москва');
$app_settings_model->set($plugin_id, 'default_region', '77');
$app_settings_model->set($plugin_id, 'default_country', 'rus');