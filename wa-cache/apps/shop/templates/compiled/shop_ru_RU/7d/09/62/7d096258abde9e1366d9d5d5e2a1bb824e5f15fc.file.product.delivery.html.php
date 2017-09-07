<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:35
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.delivery.html" */ ?>
<?php /*%%SmartyHeaderCode:150437930059b0eb0fce0b39-69947844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d096258abde9e1366d9d5d5e2a1bb824e5f15fc' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.delivery.html',
      1 => 1504601839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150437930059b0eb0fce0b39-69947844',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb0fced2e1_51101526',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb0fced2e1_51101526')) {function content_59b0eb0fced2e1_51101526($_smarty_tpl) {?><div class="delivers drop">
    <div class="entry-title">
        <h3 data-target="#id3" class="accord">Доставка <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 в <span class="cityName"></span></h3>
        <a href="#" class="show-all desc" onclick="$('#city_select_link').click();return false;">Выбрать другой город</a>
    </div>

    <?php echo shopEdostPlugin::display();?>

    
</div><?php }} ?>