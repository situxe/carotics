<?php
/**
 * @package shopGroupattrPlugin
 * @author Serge Rodovnichenko <sergerod@gmail.com>
 * @license http://www.webasyst.com/terms/#eula Webasyst
 * @version 1.1.3
 */

/**
 * Main plugin class
 */
class shopGroupattrPlugin extends shopPlugin
{
    public static function process(shopProduct $product)
    {
        $features = $product->features;

        $group_model = new shopGroupattrGroupsModel();

        try {
            $type_groups = $group_model->getByField('type_id', $product->type_id);
        } catch (waException $e) {
            waLog::log("groupattr plugin. Error quering database from process method. " . $e->getMessage());
            $type_groups = null;
        }

        if ($type_groups &&
            is_array($type_groups) &&
            array_key_exists('product_features', $type_groups) &&
            !empty($type_groups['product_features'])
        ) {
            $groups = json_decode($type_groups['product_features'], true);
        } else {
            $groups = array();
        }

        $grouped_features = array(array('features' => $features));

        foreach ($groups as $group) {
            if (isset($group['features']) && !empty($group['features'])) {
                if (!isset($group['invisible']) || !$group['invisible']) {
                    $newgroup = array('name' => $group['name'], 'features' => array());
                    foreach ($group['features'] as $fk) {
                        if (array_key_exists($fk, $features)) {
                            $newgroup['features'][$fk] = $features[$fk];
                            unset($features[$fk]);
                        }
                    }
                    $grouped_features[] = $newgroup;
                } else {
                    foreach ($group['features'] as $fk) {
                        if (array_key_exists($fk, $features)) {
                            unset($features[$fk]);
                        }
                    }
                }
            }
        }

        $grouped_features[0]['features'] = $features;
        return $grouped_features;
    }
}
