<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:37
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/edost/templates/actions/frontend/FrontendEdost.html" */ ?>
<?php /*%%SmartyHeaderCode:185275759959b0eb113af6f6-63927512%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3831763c4915020b048f6842dd84b91e42940648' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/edost/templates/actions/frontend/FrontendEdost.html',
      1 => 1504601744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185275759959b0eb113af6f6-63927512',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'edost_format' => 0,
    'map_json' => 0,
    'format' => 0,
    'f' => 0,
    'v' => 0,
    'f_key' => 0,
    'k' => 0,
    'ico_path' => 0,
    'shipping' => 0,
    'edost_address' => 0,
    'checkout_shipping_methods' => 0,
    'm' => 0,
    'ico' => 0,
    'r_key' => 0,
    'r' => 0,
    'description' => 0,
    'name' => 0,
    'day' => 0,
    'webasyst_tariff' => 0,
    'sign' => 0,
    'head' => 0,
    'active' => 0,
    'border' => 0,
    'cod' => 0,
    'table_width' => 0,
    'cod_width' => 0,
    'i' => 0,
    'i2' => 0,
    'count' => 0,
    's' => 0,
    'a' => 0,
    'k2' => 0,
    'office_map' => 0,
    'to_office' => 0,
    'id' => 0,
    'value' => 0,
    'price_long' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb11a1deb7_48554870',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb11a1deb7_48554870')) {function content_59b0eb11a1deb7_48554870($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['map_json'] = new Smarty_variable($_smarty_tpl->tpl_vars['edost_format']->value['map_json'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['map_json'] = new Smarty_variable((('[{').($_smarty_tpl->tpl_vars['map_json']->value)).('}]'), null, 0);?>
<?php $_smarty_tpl->tpl_vars['map_json'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['map_json']->value,true), null, 0);?>


<?php $_smarty_tpl->tpl_vars['edost_address'] = new Smarty_variable(false, null, 0);?>
<?php if (!isset($_smarty_tpl->tpl_vars['edost_format']->value)){?>
    <?php $_smarty_tpl->tpl_vars['format'] = new Smarty_variable(false, null, 0);?>
<?php }else{ ?>
    <?php $_smarty_tpl->tpl_vars['format'] = new Smarty_variable($_smarty_tpl->tpl_vars['edost_format']->value, null, 0);?>
    <?php $_smarty_tpl->tpl_vars['ico_path'] = new Smarty_variable($_smarty_tpl->tpl_vars['format']->value['ico_path'], null, 0);?>
    <?php $_smarty_tpl->tpl_vars['sign'] = new Smarty_variable($_smarty_tpl->tpl_vars['format']->value['sign'], null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['f_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['format']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['f_key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>
        <?php if (!empty($_smarty_tpl->tpl_vars['f']->value['tariff'])){?><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['tariff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
            <?php if (isset($_smarty_tpl->tpl_vars['v']->value['id'])){?>
                <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data'][$_smarty_tpl->tpl_vars['f_key']->value]['tariff'][$_smarty_tpl->tpl_vars['k']->value]['shipping_id'] = $_smarty_tpl->tpl_vars['format']->value['shipping_id'];?>
                <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data'][$_smarty_tpl->tpl_vars['f_key']->value]['tariff'][$_smarty_tpl->tpl_vars['k']->value]['plugin'] = $_smarty_tpl->tpl_vars['format']->value['plugin'];?>
                <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data'][$_smarty_tpl->tpl_vars['f_key']->value]['tariff'][$_smarty_tpl->tpl_vars['k']->value]['currency'] = 'RUB';?>
                <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data'][$_smarty_tpl->tpl_vars['f_key']->value]['tariff'][$_smarty_tpl->tpl_vars['k']->value]['ico'] = ((string)$_smarty_tpl->tpl_vars['ico_path']->value).((string)$_smarty_tpl->tpl_vars['v']->value['ico']).".gif";?>
                <?php if ($_smarty_tpl->tpl_vars['format']->value['shipping_id']==$_smarty_tpl->tpl_vars['shipping']->value['id']&&$_smarty_tpl->tpl_vars['v']->value['id']==$_smarty_tpl->tpl_vars['shipping']->value['rate_id']&&!empty($_smarty_tpl->tpl_vars['v']->value['office_address_full'])&&empty($_smarty_tpl->tpl_vars['v']->value['hide'])){?>
                    <?php $_smarty_tpl->tpl_vars['edost_address'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value['office_address_full'], null, 0);?>
                <?php }?>
            <?php }?>
        <?php } ?>
        <?php }?>
    <?php } ?>
    <?php if ($_smarty_tpl->tpl_vars['edost_address']->value===false){?>
        <?php $_smarty_tpl->tpl_vars['edost_address'] = new Smarty_variable($_smarty_tpl->tpl_vars['format']->value['address_original'], null, 0);?>
    <?php }?>
<?php }?>




<?php $_smarty_tpl->tpl_vars['webasyst_tariff'] = new Smarty_variable(array(), null, 0);?>

<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['checkout_shipping_methods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
    <?php if (!empty($_smarty_tpl->tpl_vars['m']->value['logo'])){?>
        <?php $_smarty_tpl->tpl_vars['ico'] = new Smarty_variable($_smarty_tpl->tpl_vars['m']->value['logo'], null, 0);?>
    <?php }else{ ?>
        <?php $_smarty_tpl->tpl_vars['ico'] = new Smarty_variable('', null, 0);?>
    <?php }?>

    <?php if (!empty($_smarty_tpl->tpl_vars['m']->value['error'])){?>
        <?php $_smarty_tpl->createLocalArrayVariable('webasyst_tariff', null, 0);
$_smarty_tpl->tpl_vars['webasyst_tariff']->value[] = array('shipping_id'=>$_smarty_tpl->tpl_vars['m']->value['id'],'plugin'=>$_smarty_tpl->tpl_vars['m']->value['plugin'],'id'=>'','company'=>$_smarty_tpl->tpl_vars['m']->value['name'],'name'=>'','description'=>'','ico'=>$_smarty_tpl->tpl_vars['ico']->value,'price'=>0,'day2'=>'','insurance'=>'','currency'=>'','error'=>$_smarty_tpl->tpl_vars['m']->value['error']);?>
    <?php }else{ ?>
        <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_smarty_tpl->tpl_vars['r_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['m']->value['rates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
 $_smarty_tpl->tpl_vars['r_key']->value = $_smarty_tpl->tpl_vars['r']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['m']->value['plugin']!='edost'){?>
                <?php if (!preg_match('/.+01/',$_smarty_tpl->tpl_vars['r_key']->value)){?>
                    <?php continue 1?>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['r']->value['description'])){?>
                    <?php $_smarty_tpl->tpl_vars['description'] = new Smarty_variable($_smarty_tpl->tpl_vars['r']->value['description'], null, 0);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars['description'] = new Smarty_variable('', null, 0);?>
                <?php }?>
                <?php if (empty($_smarty_tpl->tpl_vars['description']->value)&&!empty($_smarty_tpl->tpl_vars['m']->value['description'])){?>
                    <?php $_smarty_tpl->tpl_vars['description'] = new Smarty_variable($_smarty_tpl->tpl_vars['m']->value['description'], null, 0);?>
                <?php }?>
                <?php if (!empty($_smarty_tpl->tpl_vars['r']->value['name'])){?>
                    <?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable($_smarty_tpl->tpl_vars['r']->value['name'], null, 0);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable('', null, 0);?>
                <?php }?>
                <?php if (!empty($_smarty_tpl->tpl_vars['r']->value['est_delivery'])){?>
                    <?php $_smarty_tpl->tpl_vars['day'] = new Smarty_variable($_smarty_tpl->tpl_vars['r']->value['est_delivery'], null, 0);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars['day'] = new Smarty_variable('', null, 0);?>
                <?php }?>
                <?php $_smarty_tpl->createLocalArrayVariable('webasyst_tariff', null, 0);
$_smarty_tpl->tpl_vars['webasyst_tariff']->value[] = array('shipping_id'=>$_smarty_tpl->tpl_vars['m']->value['id'],'plugin'=>$_smarty_tpl->tpl_vars['m']->value['plugin'],'id'=>$_smarty_tpl->tpl_vars['r_key']->value,'company'=>$_smarty_tpl->tpl_vars['m']->value['name'],'name'=>$_smarty_tpl->tpl_vars['name']->value,'description'=>$_smarty_tpl->tpl_vars['description']->value,'ico'=>$_smarty_tpl->tpl_vars['ico']->value,'price'=>$_smarty_tpl->tpl_vars['r']->value['rate'],'day2'=>$_smarty_tpl->tpl_vars['day']->value,'insurance'=>'','currency'=>$_smarty_tpl->tpl_vars['r']->value['currency'],'comment'=>$_smarty_tpl->tpl_vars['r']->value['comment']);?>
            <?php }?>
            <?php }
if (!$_smarty_tpl->tpl_vars['r']->_loop) {
?>
            <?php $_smarty_tpl->createLocalArrayVariable('webasyst_tariff', null, 0);
$_smarty_tpl->tpl_vars['webasyst_tariff']->value[] = array('shipping_id'=>$_smarty_tpl->tpl_vars['m']->value['id'],'plugin'=>$_smarty_tpl->tpl_vars['m']->value['plugin'],'id'=>$_smarty_tpl->tpl_vars['r_key']->value,'company'=>$_smarty_tpl->tpl_vars['m']->value['name'],'name'=>$_smarty_tpl->tpl_vars['name']->value,'description'=>$_smarty_tpl->tpl_vars['description']->value,'ico'=>$_smarty_tpl->tpl_vars['ico']->value,'price'=>$_smarty_tpl->tpl_vars['r']->value['rate'],'day2'=>$_smarty_tpl->tpl_vars['day']->value,'insurance'=>'','currency'=>$_smarty_tpl->tpl_vars['r']->value['currency'],'comment'=>$_smarty_tpl->tpl_vars['r']->value['comment']);?>
        <?php } ?>
    <?php }?>
<?php } ?>

<?php if (!empty($_smarty_tpl->tpl_vars['webasyst_tariff']->value)){?>
    <?php if (empty($_smarty_tpl->tpl_vars['format']->value)){?>
        <?php $_smarty_tpl->tpl_vars['format'] = new Smarty_variable(array('data'=>array(),'count'=>0), null, 0);?>
    <?php }?>
    <?php if (empty($_smarty_tpl->tpl_vars['format']->value['data']['general'])){?>
        <?php if (!empty($_smarty_tpl->tpl_vars['sign']->value['general_head'])){?>
            <?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable($_smarty_tpl->tpl_vars['sign']->value['general_head'], null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable('', null, 0);?>
        <?php }?>
        <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data']['general'] = array('head'=>$_smarty_tpl->tpl_vars['head']->value,'cod'=>'','description'=>'','warning'=>'','insurance'=>'','tariff'=>array());?>
    <?php }else{ ?>
        <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data']['general']['tariff'][] = array('delimiter'=>true);?>
    <?php }?>
    <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['count'] = $_smarty_tpl->tpl_vars['format']->value['count']+count($_smarty_tpl->tpl_vars['webasyst_tariff']->value);?>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['webasyst_tariff']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
        <?php $_smarty_tpl->createLocalArrayVariable('format', null, 0);
$_smarty_tpl->tpl_vars['format']->value['data']['general']['tariff'][] = $_smarty_tpl->tpl_vars['v']->value;?>
    <?php } ?>
<?php }?>
<div class="edost_main">
    <?php if (empty($_smarty_tpl->tpl_vars['format']->value['data'])){?>
        <em class="error">Oops! We are sorry, but <strong>we can not ship this order to your selected destination</strong>. Checkout can not be completed.</em>
    <?php }else{ ?>

        <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable(false, null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['f_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['format']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['f_key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>
            <?php if (!empty($_smarty_tpl->tpl_vars['f']->value['tariff'])){?>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['tariff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php if (isset($_smarty_tpl->tpl_vars['v']->value['id'])){?>
                    <?php if ($_smarty_tpl->tpl_vars['v']->value['shipping_id']==$_smarty_tpl->tpl_vars['shipping']->value['id']&&$_smarty_tpl->tpl_vars['v']->value['id']==$_smarty_tpl->tpl_vars['shipping']->value['rate_id']){?>
                        <?php $_smarty_tpl->tpl_vars['active'] = new Smarty_variable(true, null, 0);?>
                    <?php }?>
                <?php }?>
                <?php } ?>
            <?php }?>
        <?php } ?>
        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['autoselect'])||!$_smarty_tpl->tpl_vars['active']->value){?>
            <?php $_smarty_tpl->tpl_vars['autoselect'] = new Smarty_variable(true, null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['autoselect'] = new Smarty_variable(false, null, 0);?>
        <?php }?>

        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['warning'])){?>
            <div class="edost_warning edost_warning_big"><?php echo $_smarty_tpl->tpl_vars['format']->value['warning'];?>
</div>
            <br>
        <?php }?>

        <?php $_smarty_tpl->tpl_vars['border_active'] = new Smarty_variable(false, null, 0);?>
        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['border'])){?>
            <?php $_smarty_tpl->tpl_vars['border'] = new Smarty_variable($_smarty_tpl->tpl_vars['format']->value['border'], null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['border'] = new Smarty_variable(false, null, 0);?>
        <?php }?>
        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['cod'])){?>
            <?php $_smarty_tpl->tpl_vars['cod'] = new Smarty_variable($_smarty_tpl->tpl_vars['format']->value['cod'], null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['cod'] = new Smarty_variable(false, null, 0);?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['border']->value){?>
            <?php $_smarty_tpl->tpl_vars['top'] = new Smarty_variable(15, null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['top'] = new Smarty_variable(40, null, 0);?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['format']->value['count']==1){?>
            <?php $_smarty_tpl->tpl_vars['hide_radio'] = new Smarty_variable(true, null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['hide_radio'] = new Smarty_variable(false, null, 0);?>
        <?php }?>

        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['priceinfo'])){?>
            <?php $_smarty_tpl->tpl_vars['table_width'] = new Smarty_variable(645, null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['table_width'] = new Smarty_variable(570, null, 0);?>
            <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['day'])){?>
                <?php $_smarty_tpl->tpl_vars['table_width'] = new Smarty_variable(620, null, 0);?>
            <?php }?>
        <?php }?>

        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['day'])){?>
            <?php $_smarty_tpl->tpl_vars['day_width'] = new Smarty_variable(80, null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['day_width'] = new Smarty_variable(10, null, 0);?>
        <?php }?>

        <?php $_smarty_tpl->tpl_vars['price_width'] = new Smarty_variable(85, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['cod_width'] = new Smarty_variable(90, null, 0);?>

        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>




        <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_smarty_tpl->tpl_vars['f_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['format']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
 $_smarty_tpl->tpl_vars['f_key']->value = $_smarty_tpl->tpl_vars['f']->key;
?>

            <?php if (!empty($_smarty_tpl->tpl_vars['f']->value['tariff'])){?>
                <?php if ($_smarty_tpl->tpl_vars['cod']->value&&($_smarty_tpl->tpl_vars['f']->value['cod']||$_smarty_tpl->tpl_vars['border']->value)){?>
                    <?php $_smarty_tpl->tpl_vars['w'] = new Smarty_variable($_smarty_tpl->tpl_vars['table_width']->value, null, 0);?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->tpl_vars['w'] = new Smarty_variable($_smarty_tpl->tpl_vars['table_width']->value-$_smarty_tpl->tpl_vars['cod_width']->value, null, 0);?>
                <?php }?>
                <div id="edost_<?php echo $_smarty_tpl->tpl_vars['f_key']->value;?>
_div" class="<?php if (!$_smarty_tpl->tpl_vars['border']->value||$_smarty_tpl->tpl_vars['f']->value['head']==''){?>edost_format<?php }else{ ?>edost_format_border<?php $_smarty_tpl->tpl_vars['border_active'] = new Smarty_variable(true, null, 0);?><?php }?>">
                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value['head']!=''){?><?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable("<div class=\"edost_format_head\">".((string)$_smarty_tpl->tpl_vars['f']->value['head']).":</div>", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['head'] = new Smarty_variable('', null, 0);?><?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['cod']->value&&$_smarty_tpl->tpl_vars['f']->value['cod']){?>

                    <?php }else{ ?>
                        <?php if ($_smarty_tpl->tpl_vars['head']->value!=''){?>
                            <?php echo $_smarty_tpl->tpl_vars['head']->value;?>

                            <div style="padding: 8px 0 0 0;"></div>
                            <div style="padding: 3px 0 0 0;"></div>
                        <?php }?>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['f']->value['warning']!=''){?>
                        <div class="edost_warning edost_format_info"><?php echo $_smarty_tpl->tpl_vars['f']->value['warning'];?>
</div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value['description']!=''){?>
                        <div class="edost_format_info"><?php echo $_smarty_tpl->tpl_vars['f']->value['description'];?>
</div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value['insurance']!=''){?>
                        <div class="edost_format_info"><span class="edost_insurance"><?php echo $_smarty_tpl->tpl_vars['f']->value['insurance'];?>
</span></div><?php }?>

                    <?php $_smarty_tpl->tpl_vars['i2'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['f']->value['tariff']), null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['tariff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                        <?php $_smarty_tpl->tpl_vars['i2'] = new Smarty_variable($_smarty_tpl->tpl_vars['i2']->value+1, null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['i2']->value!=$_smarty_tpl->tpl_vars['count']->value){?>
                            <?php $_smarty_tpl->createLocalArrayVariable('f', null, 0);
$_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['k']->value]['delimiter_small'] = true;?>
                        <?php }?>
                        <?php if (isset($_smarty_tpl->tpl_vars['v']->value['delimiter'])){?>
                            <?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable($_smarty_tpl->tpl_vars['k']->value-1, null, 0);?>
                            <?php if (isset($_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['s']->value]['format'])){?>
                                <?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable($_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['s']->value]['format'], null, 0);?>
                            <?php }else{ ?>
                                <?php $_smarty_tpl->tpl_vars['s'] = new Smarty_variable('', null, 0);?>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['s']->value=='shop'||$_smarty_tpl->tpl_vars['s']->value=='office'||$_smarty_tpl->tpl_vars['s']->value=='terminal'){?>
                                <?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(true, null, 0);?>
                            <?php }else{ ?>
                                <?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(false, null, 0);?>
                            <?php }?>
                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['name'] = 'delimiter';
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'] = (int)$_smarty_tpl->tpl_vars['k']->value;
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['k']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['delimiter']['total']);
?>
                                <?php $_smarty_tpl->tpl_vars['k2'] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['section']['delimiter']['index'], null, 0);?>
                                <?php if ($_smarty_tpl->tpl_vars['a']->value&&isset($_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['k2']->value]['format'])&&$_smarty_tpl->tpl_vars['s']->value!=$_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['k2']->value]['format']){?>
                                    <?php break 1?>
                                <?php }?>
                                <?php $_smarty_tpl->createLocalArrayVariable('f', null, 0);
$_smarty_tpl->tpl_vars['f']->value['tariff'][$_smarty_tpl->tpl_vars['k2']->value]['delimiter_small'] = false;?>
                                <?php if (!$_smarty_tpl->tpl_vars['a']->value){?>
                                    <?php break 1?>
                                <?php }?>
                            <?php endfor; endif; ?>
                        <?php }?>
                    <?php } ?>
                    <div class="delivers-table acc-target">
                        <div class="head">
                            <p class="box1">Перевозчики</p>
                            <p class="box2">Срок</p>
                            <p class="box3" style="font-size: 14px;">C предоплатой заказа,<i class="fa fa-rub" aria-hidden="true"></i></p>
                            <p class="box4" style="font-size: 14px;">C оплатой при получении, <i class="fa fa-rub" aria-hidden="true"></i></p>
                        </div>
                        <div class="table-body">
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['f']->value['tariff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>

                                <?php if (isset($_smarty_tpl->tpl_vars['v']->value['head'])&&trim($_smarty_tpl->tpl_vars['v']->value['head'])=='До терминала ТК'){?>
                                    <?php continue 1?>
                                <?php }?>


                                <?php if (isset($_smarty_tpl->tpl_vars['v']->value['office_map'])){?>
                                    <?php $_smarty_tpl->tpl_vars['office_map'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value['office_map'], null, 0);?>
                                <?php }else{ ?>
                                    <?php $_smarty_tpl->tpl_vars['office_map'] = new Smarty_variable('', null, 0);?>
                                <?php }?>

                                <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['to_office'])){?>
                                    <?php $_smarty_tpl->tpl_vars['to_office'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value['to_office'], null, 0);?>
                                <?php }else{ ?>
                                    <?php $_smarty_tpl->tpl_vars['to_office'] = new Smarty_variable('', null, 0);?>
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['office_map']->value!=''&&isset($_smarty_tpl->tpl_vars['v']->value['office_mode'])){?>
                                    <?php $_smarty_tpl->tpl_vars['office_mode'] = new Smarty_variable("_".((string)$_smarty_tpl->tpl_vars['v']->value['office_mode']), null, 0);?>
                                <?php }else{ ?>
                                    <?php $_smarty_tpl->tpl_vars['office_mode'] = new Smarty_variable('', null, 0);?>
                                <?php }?>

                                <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable("shipping_".((string)$_smarty_tpl->tpl_vars['v']->value['shipping_id'])."_".((string)$_smarty_tpl->tpl_vars['v']->value['id']), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['v']->value['shipping_id']).".".((string)$_smarty_tpl->tpl_vars['v']->value['id']), null, 0);?>
                                <?php if ($_smarty_tpl->tpl_vars['to_office']->value!=''){?>
                                    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['id']->value)."_".((string)$_smarty_tpl->tpl_vars['to_office']->value), null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['value'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['value']->value)."_".((string)$_smarty_tpl->tpl_vars['to_office']->value), null, 0);?>
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['office_map']->value=='get'){?>
                                    <?php $_smarty_tpl->tpl_vars['onclick'] = new Smarty_variable("edost_office.window('".((string)$_smarty_tpl->tpl_vars['v']->value['office_mode'])."', true);", null, 0);?>
                                <?php }else{ ?>
                                    <?php $_smarty_tpl->tpl_vars['onclick'] = new Smarty_variable('edost_SetActive(this.id);', null, 0);?>
                                <?php }?>
                                <?php if (isset($_smarty_tpl->tpl_vars['v']->value['price_long'])){?>
                                    <?php $_smarty_tpl->tpl_vars['price_long'] = new Smarty_variable($_smarty_tpl->tpl_vars['v']->value['price_long'], null, 0);?>
                                <?php }else{ ?>
                                    <?php $_smarty_tpl->tpl_vars['price_long'] = new Smarty_variable('', null, 0);?>
                                <?php }?>
                                <?php if (isset($_smarty_tpl->tpl_vars['v']->value['office_mode'])&&$_smarty_tpl->tpl_vars['office_map']->value=='get'&&!empty($_smarty_tpl->tpl_vars['sign']->value['office_description'][$_smarty_tpl->tpl_vars['v']->value['office_mode']])){?>
                                    <?php $_smarty_tpl->createLocalArrayVariable('v', null, 0);
$_smarty_tpl->tpl_vars['v']->value['description'] = $_smarty_tpl->tpl_vars['sign']->value['office_description'][$_smarty_tpl->tpl_vars['v']->value['office_mode']];?>
                                <?php }?>
                                <div class="table-row">
                                    <p class="box1">
                                        <a class="green-href border_bottom_dashed" href="#" data-fancybox="modal" data-src="#modal-sdek">
                                            <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['ico'])){?>
                                                <img class="edost_ico edost_ico_normal" src="<?php echo $_smarty_tpl->tpl_vars['v']->value['ico'];?>
" border="0">
                                            <?php }else{ ?>
                                                <div class="edost_ico"></div>
                                            <?php }?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['v']->value['head'])){?><?php echo $_smarty_tpl->tpl_vars['v']->value['head'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value['company'];?>
<?php }?>
                                        </a>
                                        <?php if ($_smarty_tpl->tpl_vars['v']->value['name']!=''&&!isset($_smarty_tpl->tpl_vars['v']->value['company_head'])){?>
                                            <span class="edost_format_name"> (<?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
)</span>
                                        <?php }?>

                                        <?php if ($_smarty_tpl->tpl_vars['v']->value['insurance']!=''){?>
                                            <br>
                                            <span class="edost_insurance"><?php echo $_smarty_tpl->tpl_vars['v']->value['insurance'];?>
</span>
                                        <?php }?>


                                        <?php if ($_smarty_tpl->tpl_vars['office_map']->value=='get'){?>
                                            <br>
                                            <span class="edost_format_link_big" onclick="edost_office.window('<?php echo $_smarty_tpl->tpl_vars['v']->value['office_mode'];?>
');"><?php echo $_smarty_tpl->tpl_vars['v']->value['office_link'];?>
</span>
                                        <?php }?>
                                        <strong style="color: red;"><?php echo $_smarty_tpl->tpl_vars['v']->value['comment'];?>
</strong>
                                        <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['description'])||!empty($_smarty_tpl->tpl_vars['v']->value['warning'])||!empty($_smarty_tpl->tpl_vars['v']->value['error'])){?>


                                            <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['error'])){?>
                                                <span class="edost_format_description edost_warning"><b><?php echo $_smarty_tpl->tpl_vars['v']->value['error'];?>
</b></span>
                                            <?php }?>

                                            <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['warning'])){?>
                                                <span class="edost_format_description edost_warning"><?php echo $_smarty_tpl->tpl_vars['v']->value['warning'];?>
</span>
                                            <?php }?>

                                            <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['description'])){?>
                                                <span class="edost_format_description edost_description"><?php echo $_smarty_tpl->tpl_vars['v']->value['description'];?>
</span>
                                            <?php }?>


                                        <?php }?>
                                    </p>
                                    <p class="box0 mobile">
                                        <?php if (!empty($_smarty_tpl->tpl_vars['v']->value['ico'])){?>
                                        <img class="edost_ico edost_ico_normal" src="<?php echo $_smarty_tpl->tpl_vars['v']->value['ico'];?>
" border="0" />
                                        <?php }else{ ?>
                                    <div class="edost_ico"></div>
                                    <?php }?>
                                    </p>
                                    <p class="box2"><?php if (!empty($_smarty_tpl->tpl_vars['v']->value['day'])){?><?php echo $_smarty_tpl->tpl_vars['v']->value['day'];?>
<?php }else{ ?>-<?php }?></p>
                                    <p class="box3">
                                        <?php if ($_smarty_tpl->tpl_vars['v']->value['comment']!='Недоступно'){?>
                                            <?php if (isset($_smarty_tpl->tpl_vars['v']->value['free'])){?>
                                                <span class="edost_format_price edost_price_free" style="<?php if ($_smarty_tpl->tpl_vars['price_long']->value=='light'){?>opacity: 0.5;<?php }?>"><?php echo $_smarty_tpl->tpl_vars['v']->value['free'];?>
</span>
                                            <?php }else{ ?>
                                                <span class="edost_format_price edost_price" style="<?php if ($_smarty_tpl->tpl_vars['price_long']->value=='light'){?>opacity: 0.5;<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['v']->value['priceinfo_formatted'])){?><?php echo $_smarty_tpl->tpl_vars['v']->value['priceinfo_formatted'];?>
<?php }elseif(isset($_smarty_tpl->tpl_vars['v']->value['price_formatted'])){?><?php echo $_smarty_tpl->tpl_vars['v']->value['price_formatted'];?>
<?php }else{ ?><?php echo shop_currency($_smarty_tpl->tpl_vars['v']->value['price'],$_smarty_tpl->tpl_vars['v']->value['currency']);?>
<?php }?></span>
                                            <?php }?>
                                        <?php }?>
                                    </p>
                                    <p class="box4 <?php if (isset($_smarty_tpl->tpl_vars['v']->value['pricecod'])&&$_smarty_tpl->tpl_vars['v']->value['pricecod']>=0){?><?php }else{ ?>unknown<?php }?>">
                                        <?php if (isset($_smarty_tpl->tpl_vars['v']->value['pricecod'])&&$_smarty_tpl->tpl_vars['v']->value['pricecod']>=0){?>
                                            <label for="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><span class="edost_price_head edost_payment"><?php if (isset($_smarty_tpl->tpl_vars['v']->value['cod_free'])){?><?php echo $_smarty_tpl->tpl_vars['v']->value['cod_free'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value['pricecod_formatted'];?>
<?php }?></span></label>
                                        <?php }else{ ?>
                                            Недоступно
                                        <?php }?>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>


        <?php if (!empty($_smarty_tpl->tpl_vars['format']->value['map_json'])){?>
            <input autocomplete="off" id="edost_office_data" value='{"ico_path": "<?php echo $_smarty_tpl->tpl_vars['ico_path']->value;?>
", <?php echo $_smarty_tpl->tpl_vars['format']->value['map_json'];?>
}' type="hidden">
        <?php }?>


        <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['checkout_shipping_methods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
            <input name="rate_id[<?php echo $_smarty_tpl->tpl_vars['m']->value['id'];?>
]" id="rate_id[<?php echo $_smarty_tpl->tpl_vars['m']->value['id'];?>
]" value="<?php if ($_smarty_tpl->tpl_vars['m']->value['id']==$_smarty_tpl->tpl_vars['shipping']->value['id']){?><?php echo $_smarty_tpl->tpl_vars['shipping']->value['rate_id'];?>
<?php }?>" type="hidden">
        <?php } ?>
        <input name="shipping_id" id="shipping_id" value="<?php echo $_smarty_tpl->tpl_vars['shipping']->value['id'];?>
" type="radio" checked="checked" style="display: none;">
    <?php }?>
</div>
<?php }} ?>