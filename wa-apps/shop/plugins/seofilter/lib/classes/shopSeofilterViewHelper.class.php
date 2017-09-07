<?php

class shopSeofilterViewHelper extends waViewHelper
{
	public static function paginationDecorate($pagination)
	{
		if (waRequest::param('plugin') !== 'seofilter')
		{
			return $pagination;
		}

		$pagination = preg_replace(
			'/(<a .*?href=".*?\?)(page=\d+)?(?:.*?)(\".*?>)/',
			'$1$2$3',
			$pagination
		);
		$pagination = preg_replace(
			'/(<a .*?href=".*?)\?(\".*?>)/',
			'$1$2',
			$pagination
		);

		return $pagination;
	}

	public static function getFilterUrl($feature_id, $value_id)
	{
		$seo_feature_model = new shopSeofilterFeaturesModel();
		$url = $seo_feature_model->getOneUrl($feature_id, $value_id);

		if (!$url)
		{
			return '';
		}

		$m_category = new shopCategoryModel();
		$category = null;
		$category_url = null;

		if (waRequest::param('url_type') == 1)
		{
			if (waRequest::param('category_url') == 'category')
			{
				$category_url = '_' . $url;
				$category = $m_category->getByField('url', $category_url);
			}
		}
		else
		{
			$category_url = waRequest::param('category_url') . '/_' . $url;
			$category = $m_category->getByField('full_url', $category_url);
		}

		if ($category)
		{
			return '';
		}

		$url = wa()->getRouteUrl('shop/frontend/category', array(
			'category_url' => waRequest::param('category_url'),
//		)) . '_' . $url . '/';
		)) . $url . '/';

		return $url;
	}
}