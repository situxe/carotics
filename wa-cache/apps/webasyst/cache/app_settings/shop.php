<?php
return array (
  0 => 
  array (
    'app_id' => 'shop',
    'name' => 'currency',
    'value' => 'RUB',
  ),
  1 => 
  array (
    'app_id' => 'shop',
    'name' => 'use_product_currency',
    'value' => '0',
  ),
  2 => 
  array (
    'app_id' => 'shop.migrate',
    'name' => 'update_time',
    'value' => '1',
  ),
  3 => 
  array (
    'app_id' => 'shop',
    'name' => 'update_time',
    'value' => '1463414159',
  ),
  4 => 
  array (
    'app_id' => 'shop',
    'name' => 'country',
    'value' => 'rus',
  ),
  5 => 
  array (
    'app_id' => 'shop.seofilter',
    'name' => 'update_time',
    'value' => '1464597232',
  ),
  6 => 
  array (
    'app_id' => 'shop.redirect',
    'name' => 'update_time',
    'value' => '1',
  ),
  7 => 
  array (
    'app_id' => 'shop',
    'name' => 'theme_hash',
    'value' => '59b0e2f9d495c.1504764665',
  ),
  8 => 
  array (
    'app_id' => 'shop',
    'name' => 'list_columns',
    'value' => 'sku',
  ),
  9 => 
  array (
    'app_id' => 'shop',
    'name' => 'preview_hash',
    'value' => '595f149b34010.1499403419',
  ),
  10 => 
  array (
    'app_id' => 'shop',
    'name' => 'shipping_payment_disabled',
    'value' => '{"1":["5","7"],"2":["6","7"],"9":["5","6","7"]}',
  ),
  11 => 
  array (
    'app_id' => 'shop',
    'name' => 'checkout_flow_changed',
    'value' => '1467636006',
  ),
  12 => 
  array (
    'app_id' => 'shop.seofilter',
    'name' => 'enable',
    'value' => '1',
  ),
  13 => 
  array (
    'app_id' => 'shop.seofilter',
    'name' => 'sitemap',
    'value' => '1',
  ),
  14 => 
  array (
    'app_id' => 'shop.seofilter',
    'name' => 'js',
    'value' => '$(document).ajaxComplete(function(event, xhr, settings) {
	if ( typeof(filterValuesNames) !== "undefined" && (settings.url.indexOf("[]=") != -1 || settings.url.indexOf("?&_=") != -1) ) {

		if ( settings.url.indexOf("[]=") != -1 ) {
			var valuesUrl = JSON.parse(filterValuesNames),
				params = settings.url.replace(\'?\', \'\').split(\'&\'),
				codes = [];

			$.each(params, function(i, val) {
				if (val.indexOf("_=") == -1 && val.indexOf("sort") == -1 && val.indexOf("order") == -1 && val.indexOf("[unit]") == -1) {
					codes.push(val);
				}
		    });

			if (codes.length == 1) {
				var featureCode_tmp = codes[0].split(\'[]=\'),
					featureCode = featureCode_tmp[0],
					valueId = featureCode_tmp[1];
					valueUrl = valuesUrl[featureCode][valueId];

				if (valueUrl) {
					if (!!(history.pushState && history.state !== undefined)) {
						window.history.replaceState({}, \'\', categoryUrl + \'_\' + valueUrl + \'/\');
					}
				} else {
					if (!!(history.pushState && history.state !== undefined)) {
						window.history.replaceState({}, \'\', categoryUrl + settings.url);
					}
				}
			} else {
				if (!!(history.pushState && history.state !== undefined)) {
					window.history.replaceState({}, \'\', categoryUrl + settings.url);
				}
			}
		} else if ( settings.url.indexOf("?&_=") != -1 ) {
			if (!!(history.pushState && history.state !== undefined)) {
				window.history.replaceState({}, \'\', categoryUrl);
			}
		}

		$(\'.category-name\').html($(xhr.responseText).find(\'.category-name\').html());
		$(\'.category-desc\').html($(xhr.responseText).find(\'.category-desc\').html());
		document.title = $(xhr.responseText).filter(\'.html-title\').html();

	}
});
',
  ),
  15 => 
  array (
    'app_id' => 'shop.redirect',
    'name' => 'custom',
    'value' => '[]',
  ),
  16 => 
  array (
    'app_id' => 'shop',
    'name' => 'name',
    'value' => 'Caroptics.ru',
  ),
  17 => 
  array (
    'app_id' => 'shop',
    'name' => 'email',
    'value' => '',
  ),
  18 => 
  array (
    'app_id' => 'shop',
    'name' => 'phone',
    'value' => '+1 (234) 555-1234',
  ),
  19 => 
  array (
    'app_id' => 'shop',
    'name' => 'order_format',
    'value' => '#100{$order.id}',
  ),
  20 => 
  array (
    'app_id' => 'shop',
    'name' => 'use_gravatar',
    'value' => '1',
  ),
  21 => 
  array (
    'app_id' => 'shop',
    'name' => 'gravatar_default',
    'value' => 'custom',
  ),
  22 => 
  array (
    'app_id' => 'shop',
    'name' => 'require_captcha',
    'value' => '1',
  ),
  23 => 
  array (
    'app_id' => 'shop',
    'name' => 'require_authorization',
    'value' => '0',
  ),
  24 => 
  array (
    'app_id' => 'shop',
    'name' => 'lazy_loading',
    'value' => '1',
  ),
  25 => 
  array (
    'app_id' => 'shop',
    'name' => 'map',
    'value' => 'google',
  ),
  26 => 
  array (
    'app_id' => 'shop.seo',
    'name' => 'update_time',
    'value' => '4',
  ),
  27 => 
  array (
    'app_id' => 'shop',
    'name' => 'csv.upload_path',
    'value' => 'path/to/folder/with/source/images/',
  ),
  28 => 
  array (
    'app_id' => 'shop',
    'name' => 'csv.upload_app',
    'value' => 'shop',
  ),
  29 => 
  array (
    'app_id' => 'shop.groupattr',
    'name' => 'update_time',
    'value' => '1436576333',
  ),
  30 => 
  array (
    'app_id' => 'shop',
    'name' => 'disable_backend_customer_form_validation',
    'value' => '',
  ),
  31 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'status',
    'value' => '1',
  ),
  32 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'windows',
    'value' => '1',
  ),
  33 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'rus',
    'value' => '0',
  ),
  34 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'ukr',
    'value' => '0',
  ),
  35 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'kaz',
    'value' => '0',
  ),
  36 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'blr',
    'value' => '0',
  ),
  37 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'default_city',
    'value' => 'Москва',
  ),
  38 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'default_region',
    'value' => '77',
  ),
  39 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'default_country',
    'value' => 'rus',
  ),
  40 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'update_time',
    'value' => '1',
  ),
  41 => 
  array (
    'app_id' => 'shop',
    'name' => 'ignore_stock_count',
    'value' => '0',
  ),
  42 => 
  array (
    'app_id' => 'shop',
    'name' => 'update_stock_count_on_create_order',
    'value' => '0',
  ),
  43 => 
  array (
    'app_id' => 'shop.edost',
    'name' => 'status',
    'value' => '1',
  ),
  44 => 
  array (
    'app_id' => 'shop.edost',
    'name' => 'update_time',
    'value' => '1',
  ),
  45 => 
  array (
    'app_id' => 'shop.edost',
    'name' => 'frontend_product_output',
    'value' => 'block',
  ),
  46 => 
  array (
    'app_id' => 'shop.selectbycar',
    'name' => 'status',
    'value' => '1',
  ),
  47 => 
  array (
    'app_id' => 'shop.selectbycar',
    'name' => 'update_time',
    'value' => '1',
  ),
  48 => 
  array (
    'app_id' => 'shop.selectbycar',
    'name' => 'frontend_header',
    'value' => '0',
  ),
  49 => 
  array (
    'app_id' => 'shop.selectbycar',
    'name' => 'category_id',
    'value' => '558',
  ),
  50 => 
  array (
    'app_id' => 'shop.youcity',
    'name' => 'link',
    'value' => '',
  ),
  51 => 
  array (
    'app_id' => 'shop.onestep',
    'name' => 'status',
    'value' => '1',
  ),
  52 => 
  array (
    'app_id' => 'shop.categoryimage',
    'name' => 'update_time',
    'value' => '1',
  ),
  53 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'update_time',
    'value' => '1467951933',
  ),
  54 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'feature_id',
    'value' => '52',
  ),
  55 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'sizes',
    'value' => '',
  ),
  56 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'template_nav',
    'value' => '<ul class="menu-v brands">
    {foreach $brands as $b}
        <li {if $b.name == $wa->param(\'brand\')}class="selected"{/if}>
            <a href="{$b.url}" title="{$b.name|escape}">{if 0 && $b.image}
                    <img src="{$wa_url}wa-data/public/shop/brands/{$b.id}/{$b.id}{$b.image}">{else}{$b.name|escape}{/if}
            </a>
        </li>
    {/foreach}
</ul>',
  ),
  57 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'update_time',
    'value' => '1',
  ),
  58 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'askforemail',
    'value' => 'nevermind',
  ),
  59 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'notification',
    'value' => 'on',
  ),
  60 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'adminmail',
    'value' => '',
  ),
  61 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'recallmail',
    'value' => '',
  ),
  62 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'nsubject',
    'value' => 'Новый запрос обратного звонка',
  ),
  63 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'hook',
    'value' => '',
  ),
  64 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'brand_theme_template',
    'value' => '',
  ),
  65 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'template_search',
    'value' => '<div class="brand">
    {if $brand.image}
        <img src="{$wa_url}wa-data/public/shop/brands/{$brand.id}/{$brand.id}{$brand.image}" align="left">
    {/if}
    {$brand.description}
</div>
<!-- categories -->
{if $categories}
<br clear="left">
<div class="sub-categories">
    {foreach $categories as $sc}
        {$sc@iteration}
    <a href="{$sc.url}">{$sc.name|escape}</a><br />
    {/foreach}
</div>
{/if}

<br clear="left">',
  ),
  66 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'categories_filter',
    'value' => '0',
  ),
  67 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'brands_name',
    'value' => '',
  ),
  68 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'brands_meta_description',
    'value' => '',
  ),
  69 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'brands_meta_keywords',
    'value' => '',
  ),
  70 => 
  array (
    'app_id' => 'shop.productbrands',
    'name' => 'template_brands',
    'value' => '{foreach $brands as $b}
<div class="brand">
    <a href="{$b.url}">{if $b.image}<img src="{$wa_url}wa-data/public/shop/brands/{$b.id}/{$b.id}{$b.image}">{else}{$b.name}{/if}</a>
    <br>
    {$b.summary}
</div>
<br clear="left">
{/foreach}
',
  ),
  71 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dheader',
    'value' => 'Заказ обратного звонка',
  ),
  72 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dwindow',
    'value' => 'Оставьте Ваши координаты и мы позвоним Вам, чтобы ответить на все вопросы.',
  ),
  73 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dname',
    'value' => 'Ваше имя',
  ),
  74 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dphone',
    'value' => 'Телефон',
  ),
  75 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'demail',
    'value' => 'E-mail',
  ),
  76 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dcomment',
    'value' => 'Ваш вопрос',
  ),
  77 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dsubmit',
    'value' => 'Заказать звонок',
  ),
  78 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'dsuccess',
    'value' => 'Ваш запрос отправлен. В ближайшее время мы свяжемся с Вами!',
  ),
  79 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'tab_name',
    'value' => 'Обратная связь',
  ),
  80 => 
  array (
    'app_id' => 'shop.recall',
    'name' => 'askaboutproducttext',
    'value' => 'Задать вопрос об этом товаре',
  ),
  81 => 
  array (
    'app_id' => 'shop.onestep',
    'name' => 'update_time',
    'value' => '1473154007',
  ),
  82 => 
  array (
    'app_id' => 'shop.onestep',
    'name' => 'routes',
    'value' => '{"cd29a749972b3ba45efc0495b12e7a91":{"status":"1","mode":"","desktop_only":"0","page_template":"page.html","page_url":"onestep\\/","page_title":"\\u041a\\u043e\\u0440\\u0437\\u0438\\u043d\\u0430","validate":"1"}}',
  ),
  83 => 
  array (
    'app_id' => 'shop.onestep',
    'name' => 'route_hash',
    'value' => 'cd29a749972b3ba45efc0495b12e7a91',
  ),
);
