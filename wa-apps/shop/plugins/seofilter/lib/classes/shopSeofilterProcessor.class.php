<?php

class shopSeofilterProcessor
{
    public function run($feature, $value)
    {
	    $view = wa()->getView();
	    $category = $view->getVars('category');

        $masks = $this->getMasks($category['id'], $feature, $value);
        $template = $this->getTemplate();
        $settings = array();

        foreach ($masks as $i => $mask)
        {
	        $settings = self::applyMask($mask, $settings, array());
        }

        $settings = self::applyTemplate($template, $settings);

        $this->applyChanges($settings, $category);

        $view->assign('category', $category);
    }

    protected function applyChanges($settings, &$category)
    {
        $appSettingsModel = new waAppSettingsModel();

        $counter = 0;

        if (!empty($settings['meta_title'])) {
            wa()->getResponse()->setTitle($settings['meta_title']);
            $category['meta_title'] = $settings['meta_title'];
        } else {
            $counter++;
        }

        if (!empty($settings['meta_description'])) {
            wa()->getResponse()->setMeta('description', $settings['meta_description']);
        } else {
            $counter++;
        }

        if (!empty($settings['meta_keywords'])) {
            wa()->getResponse()->setMeta('keywords', $settings['meta_keywords']);
        } else {
            $counter++;
        }

        if (!empty($settings['h1'])) {
            $category['name'] = $settings['h1'];
        }

	    $category['description'] = ifset($settings['description'], '');

	    if (!$counter || !empty($category['meta_title'])) {
            $plugin_sitemap = $appSettingsModel->get(array('shop', 'seofilter'), 'sitemap');

            if ($plugin_sitemap) {
                $chpu =  wa()->getView()->getVars('chpu');
                if (isset($chpu)) {
                    wa()->getView()->assign('canonical', null);
                }
            } else {
                wa()->getView()->assign('canonical', null);
            }
        }
    }

    protected function getMasks($category_id, $feature, $value_id)
    {
        $general_settings = shopSeofilterSettingsModel::getGeneralSeofilterSettings();
        $storefront_settings = shopSeofilterSettingsModel::getStorefrontSeofilterSettings();

        $masks = array(
            $general_settings,
            $storefront_settings
        );

	    $storefront = shopSeofilterSettingsModel::getCurrentStorefront();
	    $m_seo_feature = new shopSeofilterFeaturesModel();

	    $seo_feature_info = $m_seo_feature->getSeoFeature('front', $storefront, $feature['id'], $value_id, $category_id);

	    $seo_feature_info['description'] = $seo_feature_info['seo_desc'];
	    unset($seo_feature_info['seo_desc']);

	    $masks[] = $seo_feature_info;

	    return $masks;
    }

    protected function getTemplate()
    {
        return new shopSeofilterTemplate(array('base'));
    }

    private function applyMask($primary_data, $secondary_data, $ignore_empty)
    {
        $result = $secondary_data;

        foreach ($primary_data as $key => $_primary_data)
        {
	        if (!isset($result[$key]))
	        {
		        $result[$key] = '';
	        }

            if (in_array($key, $ignore_empty) or !empty($_primary_data))
            {
                $result[$key] = $_primary_data;
            }
        }

        return $result;
    }

    private function applyTemplate(shopSeofilterTemplate $template, $data)
    {
        $result = array();

        foreach ($data as $k => $_data)
        {
            $result[$k] = $template->fetch($_data);
        }

        return $result;
    }
}
