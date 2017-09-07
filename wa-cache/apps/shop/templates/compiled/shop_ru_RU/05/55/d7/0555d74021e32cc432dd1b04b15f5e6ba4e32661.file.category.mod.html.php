<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:28
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.mod.html" */ ?>
<?php /*%%SmartyHeaderCode:33272199359b0eb0856bf85-70115634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0555d74021e32cc432dd1b04b15f5e6ba4e32661' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.mod.html',
      1 => 1500528095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33272199359b0eb0856bf85-70115634',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb085bcaa7_75908577',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb085bcaa7_75908577')) {function content_59b0eb085bcaa7_75908577($_smarty_tpl) {?>
    <div class="content-text">
        <div class="entry-title">
            <?php echo $_smarty_tpl->getSubTemplate ("soc-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            <h1 class="h3">Запчасти <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h1>
        </div>
        <?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>

    </div>
    <div class="content-pop-products mod-wrapper">
        <div class="entry-title">
            <h2 class="h3">Запчасти для автомобилей <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</h2>
        </div>
        <a href="#" class="more-prod mobile green-href">Посмотреть остальные товары на <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a>
        <?php echo $_smarty_tpl->getSubTemplate ("list-thumbs.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('sorting'=>!empty($_smarty_tpl->tpl_vars['category']->value['params']['enable_sorting'])), 0);?>

    </div>
    <?php echo $_smarty_tpl->getSubTemplate ("working.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>