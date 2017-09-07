<?php

class shopSeofilterPluginFrontendResultAction extends shopFrontendCategoryAction
{
    public function execute()
    {
        $seo_feature_url = waRequest::param('feature');
        $seo_feature_model = new shopSeofilterFeaturesModel();
        $seo_feature = $seo_feature_model->getByField('url', $seo_feature_url);

	    $m_category = new shopCategoryModel();

	    $category = null;
	    $category_url = null;

	    if (waRequest::param('url_type') == 1)
	    {
		    if (waRequest::param('category_url') == 'category')
		    {
			    $category_url = '_' . $seo_feature_url;
			    $category = $m_category->getByField('url', $category_url);
		    }
	    }
	    else
	    {
		    $category_url = waRequest::param('category_url') . '/_' . $seo_feature_url;
		    $category = $m_category->getByField('full_url', $category_url);
	    }

        if ($category or !$seo_feature) {
		    waRequest::setParam('category_url', $category_url);
		    parent::execute();

		    return;
        } else {
			$data = waRequest::get();
	        $m_feature = new shopFeatureModel();
	        $features_array = array();

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

	        if (!$features_array)
	        {
		        $f_model = new shopFeatureModel();
		        $f_ = $f_model->getById($seo_feature['feature_id']);

		        $_GET[$f_['code']] = array($seo_feature['value_id']);
		        $this->view->assign('chpu', true);
	        }
        }

	    parent::execute();
    }

    protected function getCategoryDouble()
    {
        $category_model = $this->getModel();
        $url_field = waRequest::param('url_type') == 1 ? 'url' : 'full_url';
        $current_url = waRequest::param('category_url')."/_".waRequest::param('feature');

        $category = $category_model->getByField($url_field, $current_url);

        $route = wa()->getRouting()->getDomain(null, true) . '/' . wa()->getRouting()->getRoute('url');
        if ($category) {
            $category_routes_model = new shopCategoryRoutesModel();
            $routes = $category_routes_model->getRoutes($category['id']);
        }
        if (!$category || ($routes && !in_array($route, $routes))) {
            throw new waException('Category not found', 404);
        }
        $category['subcategories'] = $category_model->getSubcategories($category, $route);
        $category_url = wa()->getRouteUrl('shop/frontend/category', array('category_url' => '%CATEGORY_URL%'));
        foreach ($category['subcategories'] as &$sc) {
            $sc['url'] = str_replace('%CATEGORY_URL%', waRequest::param('url_type') == 1 ? $sc['url'] : $sc['full_url'], $category_url);
            $sc['params'] = array();
        }
        unset($sc);

        // params for category and subcategories
        $category['params'] = array();
        $category_params_model = new shopCategoryParamsModel();
        $rows = $category_params_model->getByField('category_id', array_keys(array($category['id'] => 1) + $category['subcategories']), true);
        foreach($rows as $row) {
            if (!empty($category['subcategories'][$row['category_id']])) {
                $category['subcategories'][$row['category_id']]['params'][$row['name']] = $row['value'];
            } else if ($row['category_id'] == $category['id']) {
                $category['params'][$row['name']] = $row['value'];
            }
        }

        // smarty description
        if ($this->getConfig()->getOption('can_use_smarty') && $category['description']) {
            $category['description'] = wa()->getView()->fetch('string:' . $category['description']);
        }

        return $category;
    }
}
