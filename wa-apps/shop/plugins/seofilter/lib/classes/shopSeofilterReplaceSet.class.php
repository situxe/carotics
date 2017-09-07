<?php

class shopSeofilterReplaceSet extends shopSeofilterReplacesSet
{
	public function getReplaces()
	{
		$view = wa()->getView();
		$category = $view->getVars('category');
		$storefront = shopSeofilterSettingsModel::getCurrentStorefront();
		$settings = shopSeofilterSettingsModel::getSeofilterSettings($storefront);

		$config = wa('shop')->getConfig();

		if ($config instanceof shopConfig)
		{
			$config_store_name = $config->getGeneralSettings('name');
			$config_store_phone = $config->getGeneralSettings('phone');
		}
		else
		{
			$config_store_name = '';
			$config_store_phone = '';
		}

		$config_storefront_name = !empty($settings['storefront_name']) ? $settings['storefront_name'] : $config_store_name;

		$m_category = new shopCategoryModel();

		if ($category['parent_id'] != '0')
		{
			$parent_category = $m_category->getById($category['parent_id']);
		}
		$category_name_tmp = $m_category->select('name')->where('id = '.(int)$category['id'])->fetchAll();
		$category_name = $category_name_tmp[0]['name'];
		$parent_category_name = isset($parent_category) ? $parent_category['name'] : '';
		if (is_callable(array('shopSeoSettings', 'getByCategoryID'))) {
			$seo_cat = new shopSeoSettings();
			$category_seo_name_tmp = $seo_cat->getByCategoryID($category['id'], 'general');
		}
		if (isset($category_seo_name_tmp) && !empty($category_seo_name_tmp['category_name'])) {
			$category_seo_name = $category_seo_name_tmp['category_name'];
		} else {
			$category_seo_name = $category_name;
		}

		$m_feature = new shopFeatureModel();
		$m_seo_feature = new shopSeofilterFeaturesModel();
		$data = waRequest::get();
		$features_array = array();
		$feature_name = $value_name = '';

		foreach ($data as $key => $value) {
			if ($key != "_" && $key != "sort" && $key != "order" && $key != "page" && count($value) == 1) {
				if (is_array($value) && !isset($value['unit'])) {
					$features_array[$key] = $value;
				}
			}
		}

		foreach ($features_array as $code => $value) {
			$feature = $m_feature->getByCode($code);
			$feature_name = $feature['name'];
			$value_id = $value[0];
			$feature_values = $m_feature->getFeatureValues($feature);

			if ($feature['type'] == 'color') {
				$value_name = $feature_values[$value_id]['value'];
			} else {
				$value_name = $feature_values[$value_id];
			}

			$seo_feature = $m_seo_feature->getSeoFeature('front', $storefront, $feature['id'], $value_id, $category['id']);
		}

		if (isset($seo_feature) && $seo_feature['seo_name'] != '') {
			$seo_name = $seo_feature['seo_name'];
		} else {
			$seo_name = $value_name;
		}

		$view = wa()->getView();
		$products_count = $view->getVars('products_count');

		$replaces = array(
			new shopSeofilterVariable('store_name', $config_store_name),
			new shopSeofilterVariable('store_phone', $config_store_phone),
			new shopSeofilterVariable('storefront_name', $config_storefront_name),
			new shopSeofilterVariable('category_name', $category_name),
			new shopSeofilterVariable('category_seo_name', $category_seo_name),
			new shopSeofilterVariable('parent_category_name', $parent_category_name),
			new shopSeofilterVariable('seo_name', $seo_name),
			new shopSeofilterVariable('feature_name', $feature_name),
			new shopSeofilterVariable('value_name', $value_name),
			new shopSeofilterVariable('products_count', $products_count),
			new shopSeofilterVariable('page_number', waRequest::get('page', 1)),
		);

		$fields = shopSeofilterSettingsFieldsModel::getAllFields();

		foreach ($fields as $id => $name) {
			$value = ifset($settings['storefront_field_'.$id], '');
			$replaces[] = new shopSeofilterVariable('storefront_field_'.$id, $value);
		}

		$replaces[] = new shopSeofilterConst();

		return $replaces;
	}
}