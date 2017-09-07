<?php

return array(
    'name' => 'Edost',
    'description' => 'Вывот информации о доставке в карточке товара',
    'vendor' => 985310,
    'version' => '1.0.0',
    'img' => 'img/edost.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'frontend_product' => 'frontendProduct',
    ),
);
//EOF
