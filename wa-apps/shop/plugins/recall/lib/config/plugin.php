<?php
return array (
  'name' => 'Обратный звонок RECALL',
  'version' => '9999',
  'vendor' => 995002,
  'description' => 'Возможность по заказу обратного звонка для посетителей',
  'img' => 'img/recall.png',
  'frontend' => true,
  'shop_settings' => true,
  'handlers' => 
  array (
    'frontend_header' => 'frontendHeader',
    'backend_menu' => 'backendMenu',
    'frontend_product' => 'frontendProduct',
  ),
  'comment' => 'Меняли шаблон',
);
