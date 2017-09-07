<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:42:04
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/breadcrumb.html" */ ?>
<?php /*%%SmartyHeaderCode:62097275859b0ea3c76d7a6-04918882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '441410ce3912a79258cb26c433f763c1858d779a' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/breadcrumb.html',
      1 => 1500530183,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62097275859b0ea3c76d7a6-04918882',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_url' => 0,
    'breadcrumbs' => 0,
    'breadcrumb' => 0,
    'product' => 0,
    'category' => 0,
    'catalog_parent_url' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0ea3c803120_91699190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0ea3c803120_91699190')) {function content_59b0ea3c803120_91699190($_smarty_tpl) {?><ul class="breadcrumb">
    <li>
        <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
">Главная</a>
    </li>
    <?php if ($_smarty_tpl->tpl_vars['breadcrumbs']->value){?>
        <?php  $_smarty_tpl->tpl_vars['breadcrumb'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['breadcrumb']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['breadcrumbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['breadcrumb']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['breadcrumb']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb']->key => $_smarty_tpl->tpl_vars['breadcrumb']->value){
$_smarty_tpl->tpl_vars['breadcrumb']->_loop = true;
 $_smarty_tpl->tpl_vars['breadcrumb']->iteration++;
 $_smarty_tpl->tpl_vars['breadcrumb']->last = $_smarty_tpl->tpl_vars['breadcrumb']->iteration === $_smarty_tpl->tpl_vars['breadcrumb']->total;
?>
            <?php if ($_smarty_tpl->tpl_vars['breadcrumb']->value['url']=='/catalog/optika/'){?>
                <?php $_smarty_tpl->createLocalArrayVariable('breadcrumb', null, 0);
$_smarty_tpl->tpl_vars['breadcrumb']->value['name'] = 'Каталог';?>
            <?php }?>
            <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value['name'];?>
</a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['product']->value&&$_smarty_tpl->tpl_vars['breadcrumb']->last){?>
                <?php $_smarty_tpl->tpl_vars['catalog_parent_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['breadcrumb']->value['url'], null, 0);?>
            <?php }?>
        <?php } ?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['category']->value){?>
        <?php if ($_smarty_tpl->tpl_vars['category']->value['id']==558){?>
            <?php $_smarty_tpl->createLocalArrayVariable('category', null, 0);
$_smarty_tpl->tpl_vars['category']->value['name'] = 'Каталог';?>
        <?php }?>
        <li class="active"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</li>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['product']->value){?>
        <li class="active"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</li>
        <?php if ($_smarty_tpl->tpl_vars['catalog_parent_url']->value){?><a href="<?php echo $_smarty_tpl->tpl_vars['catalog_parent_url']->value;?>
" class="back">« вернуться к каталогу</a><?php }?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value){?>
        <li class="active"><?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
</li>
    <?php }?>
</ul><?php }} ?>