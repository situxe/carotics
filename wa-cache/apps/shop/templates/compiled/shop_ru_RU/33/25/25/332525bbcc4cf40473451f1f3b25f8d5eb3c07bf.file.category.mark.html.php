<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:20
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.mark.html" */ ?>
<?php /*%%SmartyHeaderCode:128191103759b0eb00615a84-71285281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '332525bbcc4cf40473451f1f3b25f8d5eb3c07bf' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.mark.html',
      1 => 1500527856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128191103759b0eb00615a84-71285281',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'sc' => 0,
    'wa' => 0,
    'subsubcategories' => 0,
    'subsubcategory' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb00696100_70053904',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb00696100_70053904')) {function content_59b0eb00696100_70053904($_smarty_tpl) {?><div class="content-text">
    <div class="entry-title">
        <?php echo $_smarty_tpl->getSubTemplate ("soc-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <h1 class="h3"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h1>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>

</div>
<?php if ($_smarty_tpl->tpl_vars['category']->value['subcategories']){?>
    <div class="content-models">
        <div class="entry-title">
            <h2 class="h3">Выберите модель <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h2>
        </div>
        <div class="models-wrapper">
            <ul class="models">
                <?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
$_smarty_tpl->tpl_vars['sc']->_loop = true;
?>
                    <?php $_smarty_tpl->tpl_vars['subsubcategories'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->categories($_smarty_tpl->tpl_vars['sc']->value['id']), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['subsubcategories']->value){?>
                        <li class="dropdown">
                            <a role="button" class='drop-sum closed'><?php echo $_smarty_tpl->tpl_vars['sc']->value['name'];?>
</a>
                            <div class="drop-menu">
                                <ul>
                                    <?php  $_smarty_tpl->tpl_vars['subsubcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subsubcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subsubcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subsubcategory']->key => $_smarty_tpl->tpl_vars['subsubcategory']->value){
$_smarty_tpl->tpl_vars['subsubcategory']->_loop = true;
?>
                                        <li>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['subsubcategory']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['subsubcategory']->value['name'];?>
</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                    <?php }?>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("working.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="content-pop-products">
    <div class="entry-title">
        <h3>Популярные запчасти для автомобилей <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h3>
    </div>
    <?php echo $_smarty_tpl->getSubTemplate ("list-thumbs.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }} ?>