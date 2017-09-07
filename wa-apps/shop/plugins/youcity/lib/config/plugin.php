<?php


return array(
    'name' => 'Определение местоположения',
    'description' => 'Позволяет уточнить местоположение покупателя.',
    'img'=>'img/images.png',
    'version' => '2.0.1',
    'vendor' => 965055,
    'shop_settings' => true,
    'frontend'    => true,
    'icons'=>array(
        16 => 'img/images.png',
    ),
    'handlers' => array(
        'frontend_header' => 'frontendHeader',
        'frontend_head' => 'frontendHead'
    ),
);
