<?php
/**
 * @package shopGroupattrPlugin.controllers
 * @version 1.1.0
 * @author Serge Rodovnichenko <sergerod@gmail.com>
 * @license http://www.webasyst.com/terms/#eula Webasyst
 */

/**
 * Settings controller
 */
class shopGroupattrPluginSettingsActions extends waViewActions
{
    /** @var shopTypeModel */
    private $Type;

    /** @var shopTypeFeaturesModel */
    private $TypeFeature;

    /** @var shopGroupattrGroupsModel */
    private $Group;

    protected function preExecute()
    {
        parent::preExecute();

        wa('shop')->getPlugin('groupattr');

        $this->Type = new shopTypeModel();
        $this->TypeFeature = new shopTypeFeaturesModel();
        $this->Group = new shopGroupattrGroupsModel();
    }

    public function defaultAction()
    {
        $this->setTemplate('Settings');
        $this->view->assign('product_types', $this->Type->getTypes());
    }

    public function featuresAction()
    {
        $type_id = waRequest::get('type_id', 0, waRequest::TYPE_INT);

        if ($type_id) {
            $all_features = $this->TypeFeature->getByType($type_id);

            $type_groups = $this->Group->getByField('type_id', $type_id);

            if (!is_array($type_groups)) {
                $type_groups = array('product_features' => array());
            } else {
                $type_groups['product_features'] = json_decode($type_groups['product_features'], true);
            }

            $feature_groups[0] = array('features' => $all_features);

            foreach ($type_groups['product_features'] as $g) {
                $group = array(
                    'name'      => $g['name'],
                    'features'  => array(),
                    'invisible' => (isset($g['invisible']) ? $g['invisible'] : 0)
                );

                if (!array_key_exists('features', $g) || !is_array($g['features'])) {
                    $g['features'] = array();
                }

                foreach ($g['features'] as $gf) {

                    $key = $this->getKey($gf, $feature_groups[0]['features']);

                    if (!is_null($key)) {
                        $group['features'][] = $feature_groups[0]['features'][$key];
                        unset($feature_groups[0]['features'][$key]);
                    }
                }
                $feature_groups[] = $group;
            }

        } else {
            $all_features = $feature_groups = array();
        }

        $this->view->assign('feature_groups', $feature_groups);
        $this->view->assign('all_features', $all_features);
    }

    public function savegroupsAction()
    {
        $type_id = waRequest::post('type_id', 0, waRequest::TYPE_INT);
        $groups = waRequest::post('groups', array());
        $invisible = waRequest::post('invisible', 0, waRequest::TYPE_INT);
        $this->setTemplate(wa('shop')->getConfig()->getPluginPath('groupattr') . '/templates/json.tpl');

        $result = array();

        try {
            $this->Group->save(array(
                'type_id'          => $type_id,
                'invisible'        => $invisible,
                'product_features' => $groups
            ));
        } catch (waException $e) {
            $result['error'] = _wp("Error: ") . $e->getMessage();
        }

        $this->view->assign('result', $result);
        $this->getResponse()->addHeader('Content-type', 'application/json');

    }

    /**
     * Action for copying
     */
    public function copyAction()
    {
        $source = waRequest::post('from', 0, waRequest::TYPE_INT);
        $target = waRequest::post('to', 0, waRequest::TYPE_INT);
        $result = array();
        $this->setTemplate(wa('shop')->getConfig()->getPluginPath('groupattr') . '/templates/json.tpl');
        $this->getResponse()->addHeader('Content-type', 'application/json');

        try {
            if (!$source || !$target) {
                throw new waException(_wp('Incorrect product type ID'));
            }

            $settings = $this->Group->getByField('type_id', $source);
            var_dump($settings);
            if ($settings && isset($settings['product_features']) && $settings['product_features']) {
                $settings['product_features'] = json_decode($settings['product_features'], true);
                if (!is_array($settings['product_features'])) {
                    $settings['product_features'] = array();
                }
                unset($settings['id']);
                $target_type_features = $this->TypeFeature
                    ->query(
                        "SELECT sf.code AS `code`
                        FROM shop_type_features stf
                        LEFT JOIN shop_feature sf ON stf.feature_id=sf.id
                        WHERE stf.type_id=i:type_id",
                        array('type_id' => $target)
                    )->fetchAll(null, true);
                foreach ($settings['product_features'] as &$group) {
                    $group_features = array();
                    foreach ($group['features'] as $feature) {
                        if (in_array($feature, $target_type_features)) {
                            $group_features[] = $feature;
                        }
                    }
                    $group['features'] = $group_features;
                }
                $settings['type_id'] = $target;
                $this->Group->save($settings);
            } else {
                $this->Group->deleteByField('type_id', $target);
            }

        } catch (waException $e) {
            $result['error'] = _wp('Error: ') . $e->getMessage();
        }

        $this->view->assign('result', $result);
    }

    private function getKey($code, $data)
    {
        $key = null;

        foreach ($data as $k => $v) {
            if ($v['code'] == $code) {
                $key = $k;
                break;
            }
        }

        return $key;
    }
}
