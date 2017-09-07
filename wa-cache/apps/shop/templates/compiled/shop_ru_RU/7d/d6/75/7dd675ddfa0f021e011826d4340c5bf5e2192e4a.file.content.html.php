<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:50
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/content.html" */ ?>
<?php /*%%SmartyHeaderCode:171158458459b0e902a07596-04164262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dd675ddfa0f021e011826d4340c5bf5e2192e4a' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/content.html',
      1 => 1500884725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171158458459b0e902a07596-04164262',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'frontend_header' => 0,
    '_' => 0,
    'action' => 0,
    'hide_sidebar_actions' => 0,
    'content' => 0,
    'frontend_footer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e902a4a0f6_14830760',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e902a4a0f6_14830760')) {function content_59b0e902a4a0f6_14830760($_smarty_tpl) {?><!-- plugin hook: 'frontend_header' -->

<?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['frontend_header']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?>
<!-- current page core content -->
<?php $_smarty_tpl->tpl_vars['hide_sidebar_actions'] = new Smarty_variable(array('default','cart','checkout','product','page'), null, 0);?>
<?php if (!in_array($_smarty_tpl->tpl_vars['action']->value,$_smarty_tpl->tpl_vars['hide_sidebar_actions']->value)){?>
    <?php echo $_smarty_tpl->getSubTemplate ("sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



    <?php echo $_smarty_tpl->getSubTemplate ("breadcrumb.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <div class="content oh">
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    </div>
<?php }else{ ?>
    <div class="content">
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    </div>
<?php }?>
<div class="clear-both"></div>
<!-- plugin hook: 'frontend_footer' -->

<?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['frontend_footer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?>
<div id="dialog" class="dialog">
    <div class="dialog-background"></div>
    <div class="dialog-window">
        <!-- common part -->
        <div class="cart">
        </div>
        <!-- /common part -->
    </div>
</div><?php }} ?>