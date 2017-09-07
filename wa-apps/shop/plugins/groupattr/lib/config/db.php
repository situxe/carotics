<?php
return array(
    'shop_groupattr_groups' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'type_id' => array('int', 11, 'null' => 0),
        'product_features' => array('text', 'null' => 0),
        ':keys' => array(
            'PRIMARY' => 'id',
            'product_type_id' => 'type_id',
        ),
    ),
);
