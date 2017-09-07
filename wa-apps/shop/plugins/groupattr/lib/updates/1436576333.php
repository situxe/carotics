<?php
/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.1.0
 * @copyright Serge Rodovnichenko, 2015
 * @license http://www.webasyst.com/terms/#eula Webasyst
 *
 * Update file 1.0.x to 1.1.0 version. Adds new column which holds 'invisible' attribute for groups
 */

$model = new waModel();
try {
    $model->query('SELECT `invisible` FROM `shop_groupattr_groups` WHERE 0');
} catch (waDbException $e) {
    $model->exec('ALTER TABLE `shop_groupattr_groups` ADD COLUMN `invisible` INT(1) DEFAULT 0 AFTER `type_id`');
}
