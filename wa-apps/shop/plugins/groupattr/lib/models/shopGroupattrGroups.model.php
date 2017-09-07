<?php
/**
 * @package shopGroupattrPlugin.models
 * @author Serge Rodovnichenko <sergerod@gmail.com>
 * @license http://www.webasyst.com/terms/#eula Webasyst
 */

/**
 * Groups of attributes model
 */
class shopGroupattrGroupsModel extends waModel
{
    protected $table = 'shop_groupattr_groups';

    public function save($data)
    {
        $data['product_features'] = json_encode($data['product_features']);

        if ($this->countByField('type_id', $data['type_id'])) {
            $type_id = $data['type_id'];
            unset($data['type_id']);
            $this->updateByField('type_id', $type_id, $data);
        } else {
            $this->insert($data);
        }
    }
}
