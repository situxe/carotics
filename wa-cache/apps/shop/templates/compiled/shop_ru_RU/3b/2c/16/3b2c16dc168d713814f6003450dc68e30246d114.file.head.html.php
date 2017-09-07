<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:50
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/head.html" */ ?>
<?php /*%%SmartyHeaderCode:199112672959b0e90297aea0-28531372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b2c16dc168d713814f6003450dc68e30246d114' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/head.html',
      1 => 1499328172,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199112672959b0e90297aea0-28531372',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nofollow' => 0,
    'frontend_head' => 0,
    '_' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e902992d12_84895144',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e902992d12_84895144')) {function content_59b0e902992d12_84895144($_smarty_tpl) {?><?php if (!empty($_smarty_tpl->tpl_vars['nofollow']->value)){?>
    <!-- "nofollow" for pages not to be indexed, e.g. customer account -->
    <meta name="robots" content="noindex,nofollow" />
<?php }?>

<!-- plugin hook: 'frontend_head' -->

<?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['frontend_head']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?>
    <?php echo $_smarty_tpl->tpl_vars['_']->value;?>

<?php } ?>
<?php }} ?>