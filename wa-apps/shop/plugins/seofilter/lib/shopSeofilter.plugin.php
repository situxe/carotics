<?php

class shopSeofilterPlugin extends shopPlugin
{
    public function frontendCategory()
    {
        $plugin = wa()->getPlugin('seofilter');
        $appSettingsModel = new waAppSettingsModel();
        $seo_feature_model = new shopSeofilterFeaturesModel();
        $plugin_settings = $appSettingsModel->get(array('shop', 'seofilter'));

        if ($plugin_settings['enable']) {
            $data = waRequest::get();
            $route = waRequest::param();
            $view = wa()->getView();
            $features_array = array();

	        $m_feature = new shopFeatureModel();

            foreach ($data as $key => $value) {
                if ($key != "_" && $key != "sort" && $key != "order" && $key != "page" && count($value) == 1) {
                    if ( (is_array($value) && !isset($value['unit'])) || is_string($value) ) {
	                    if ($m_feature->getByCode($key))
	                    {
		                    $features_array[$key] = $value;
	                    }
                    }

                    if (count($features_array) > 1) {
                        $features_array = array();
                        break;
                    }
                } else if (count($value) > 1) {
                    $features_array = array();
                    break;
                }
            }

            $category = $view->getVars('category');
            $category_url = wa()->getRouteUrl('shop/frontend/category', array('category_url' => isset($route['url_type']) && ($route['url_type'] == 1) ? $category['url'] : $category['full_url']), true);

            if ($features_array) {

                foreach ($features_array as $code => $value) {
                    $feature = $m_feature->getByCode($code);

                    if ($feature['selectable']) {
                        $chpu = $view->getVars('chpu');
                        $_value = is_array($value) ? $value[0] : $value;

                        if (!isset($chpu)&& !waRequest::isXMLHttpRequest() && !isset($data['page']) && !isset($data['sort']) && !isset($data['order']) && !isset($data['showall'])) {
                            $url = $seo_feature_model->getOneUrl($feature['id'], $_value);

	                        $m_category = new shopCategoryModel();

	                        $_category = null;
	                        $_category_url = null;

	                        if (waRequest::param('url_type') == 1)
	                        {
		                        if (waRequest::param('category_url') == 'category')
		                        {
			                        $_category_url = '_' . $url;
			                        $_category = $m_category->getByField('url', $_category_url);
		                        }
	                        }
	                        else
	                        {
		                        $_category_url = waRequest::param('category_url') . '/_' . $url;
		                        $_category = $m_category->getByField('full_url', $_category_url);
	                        }

                            if ($url and !$_category) {
                                $url = $category_url."_".$url.'/';
                                wa()->getResponse()->redirect($url, 301);
                            }
                        }

                        $processor = new shopSeofilterProcessor();
                        $processor->run($feature, $_value);
                        break;
                    }
                }
            }

            $filters_url = $seo_feature_model->getSeoUrl($category);
	        $m_category = new shopCategoryModel();

	        foreach ($filters_url as $_feature => $_values)
	        {
		        foreach ($_values as $_key => $_url)
		        {
	                $_category = null;
	                $_category_url = null;

	                if (waRequest::param('url_type') == 1)
	                {
	                    if (waRequest::param('category_url') == 'category')
	                    {
	                        $_category_url = '_' . $_url;
		                    $_category = $m_category->getByField('url', $_category_url);
	                    }
	                }
	                else
	                {
		                $_category_url = waRequest::param('category_url') . '/_' . $_url;
		                $_category = $m_category->getByField('full_url', $_category_url);
	                }

			        if ($_category)
			        {
				        unset($filters_url[$_feature][$_key]);
			        }
		        }

		        if (count($filters_url[$_feature]) == 0)
		        {
			        unset($filters_url[$_feature]);
		        }
	        }

            $filters_url_json = json_encode($filters_url);

            $seoFilterUrls = "<script>var filterValuesNames = '".$filters_url_json."', categoryUrl = '".$category_url."';</script>";

            if (ifset($plugin_settings['js'], '')) {
                $script = "<script type='text/javascript'>".$plugin_settings['js']."</script>";
            } else {
                $script = "<script type='text/javascript' src='".$plugin->getPluginStaticUrl()."js/seofilter.js'></script>";
            }

	        $script .= "<script type='text/javascript' src='".$plugin->getPluginStaticUrl()."js/seofilter-link.js'></script>";
	        $script .= "<link rel='stylesheet' href='".$plugin->getPluginStaticUrl()."css/seofilter-link.css' />";

            return $seoFilterUrls.$script;
        }
    }

    public static function getVariablesTemplatePath()
    {
        $plugin = wa()->getPlugin('seofilter');

        return $plugin->path.'/templates/Variables.html';
    }

    public function sitemap($route)
    {
        $appSettingsModel = new waAppSettingsModel();
        $plugin_enable = $appSettingsModel->get(array('shop', 'seofilter'), 'enable');

        if (!$plugin_enable) {
            return false;
        }

        $urls = array();

        $m_category = new shopCategoryModel();
        $m_feature = new shopFeatureModel();
        $m_seo_feature = new shopSeofilterFeaturesModel();
        $plugin_sitemap = $appSettingsModel->get(array('shop', 'seofilter'), 'sitemap');

        $route_2 = shopSeofilterSettingsModel::getCurrentStorefront();
        $sql = "SELECT c.*
                FROM shop_category c
                LEFT JOIN shop_category_routes cr ON c.id = cr.category_id
                WHERE c.status = 1 AND (cr.route IS NULL OR cr.route = '".$route_2."')
                ORDER BY c.left_key";
        $all_categories = $m_category->query($sql)->fetchAll('id');

        foreach ($all_categories as $category) {
            if ($category['filter']) {
                $category_url = wa()->getRouteUrl('shop/frontend/category', array('category_url' => isset($route['url_type']) && ($route['url_type'] == 1) ? $category['url'] : $category['full_url']), true);

                $collection = new shopProductsCollection('category/' . $category['id']);
                $category_value_ids = $collection->getFeatureValueIds();

                $feature_ids = explode(',', $category['filter']);
                $features = $m_feature->getById(array_filter($feature_ids, 'is_numeric'));

                $filters_url = $m_seo_feature->getSeoUrl($category);

                foreach ($features as $feature) {
                    if ($feature['selectable']) {
                        $values = $m_feature->getFeatureValues($feature);

                        foreach ($values as $v_id => $v) {
                            if (in_array($v_id, $category_value_ids[$feature['id']])) {
                                if (isset($filters_url[$feature['code']]) && array_key_exists($v_id, $filters_url[$feature['code']])) {
                                    //$url = $category_url.'_'.$filters_url[$feature['code']][$v_id].'/';
                                    $url = $category_url.$filters_url[$feature['code']][$v_id].'/';
                                } else if (!$plugin_sitemap) {
                                    $url = $category_url.'?'.$feature['code'].'[]='.$v_id;
                                } else {
                                    continue;
                                }

                                $urls[] = array(
                                    'loc' => $url,
                                    'priority' => 0.6,
                                    'changefreq' => 'weekly'
                                );
                            }
                        }
                    }
                }
            }
        }

        if ($urls) {
            return $urls;
        }
    }
}
