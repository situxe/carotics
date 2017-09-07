<?php

return array(
    'name' => 'SEO-фильтр',
    'description' => 'Оптимизация результатов фильтра',
    'img' => 'img/seofilter.png',
    'vendor' => '934303',
    'frontend' => true,
    'shop_settings' => true,
    'version' => '1.2.1',
    'handlers' => array(
        'frontend_category' => 'frontendCategory',
        'sitemap' => 'sitemap'
    )
);
