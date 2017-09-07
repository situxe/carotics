<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:46
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/templates/actions/backend/BackendLoc.html" */ ?>
<?php /*%%SmartyHeaderCode:158545990959b0e8feec62d9-31776796%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87dbdc3650584cf9c31deaafd5866c193c1784c0' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/templates/actions/backend/BackendLoc.html',
      1 => 1470220184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158545990959b0e8feec62d9-31776796',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'strings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e8feefc552_51559578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e8feefc552_51559578')) {function content_59b0e8feefc552_51559578($_smarty_tpl) {?>$.wa.locale = $.extend($.wa.locale, <?php ob_start();?><?php echo json_encode($_smarty_tpl->tpl_vars['strings']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_tmp1;?>
);<?php }} ?>