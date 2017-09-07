<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:42:03
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.html" */ ?>
<?php /*%%SmartyHeaderCode:98113247559b0ea3bed6438-17613085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b5392783b3bb0860aff1fbb76548c170e625891' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.html',
      1 => 1499334129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98113247559b0ea3bed6438-17613085',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'breadcrumbs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0ea3c0839f9_36196923',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0ea3c0839f9_36196923')) {function content_59b0ea3c0839f9_36196923($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['category']->value['id']==558){?>
    <?php echo $_smarty_tpl->getSubTemplate ("category.catalog.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif(count($_smarty_tpl->tpl_vars['breadcrumbs']->value)==1&&$_smarty_tpl->tpl_vars['breadcrumbs']->value[0]['url']=='/catalog/optika/'){?>
    <?php echo $_smarty_tpl->getSubTemplate ("category.mark.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif(count($_smarty_tpl->tpl_vars['breadcrumbs']->value)==2&&$_smarty_tpl->tpl_vars['breadcrumbs']->value[0]['url']=='/catalog/optika/'){?>
    <?php echo $_smarty_tpl->getSubTemplate ("category.model.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif(count($_smarty_tpl->tpl_vars['breadcrumbs']->value)==3&&$_smarty_tpl->tpl_vars['breadcrumbs']->value[0]['url']=='/catalog/optika/'){?>
    <?php echo $_smarty_tpl->getSubTemplate ("category.mod.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?><?php }} ?>