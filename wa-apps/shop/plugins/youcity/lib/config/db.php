<?php
return array(
	'shop_youcity_cities' => array(
                                    'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
									'city' => array('varchar', 255, 'null' => 0),
									'region' => array('int', 11, 'null' => 0),
                                    'country' => array('varchar', 20, 'null' => ''),
                                    ':keys' => array(
                                           'PRIMARY' => 'id'),
                                 ),
);