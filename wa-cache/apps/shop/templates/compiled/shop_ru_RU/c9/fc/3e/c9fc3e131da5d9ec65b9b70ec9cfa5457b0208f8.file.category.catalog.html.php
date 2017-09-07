<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:42:04
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.catalog.html" */ ?>
<?php /*%%SmartyHeaderCode:97447262359b0ea3c09a827-06045794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9fc3e131da5d9ec65b9b70ec9cfa5457b0208f8' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/category.catalog.html',
      1 => 1500540764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97447262359b0ea3c09a827-06045794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'sub_cat' => 0,
    'bestcellers_mark' => 0,
    'wa_url' => 0,
    'sc' => 0,
    'f_liter' => 0,
    'subcategories' => 0,
    'liter_subcategories' => 0,
    'lsc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0ea3c14ad86_81072483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0ea3c14ad86_81072483')) {function content_59b0ea3c14ad86_81072483($_smarty_tpl) {?><div class="content-text"><p>Вы на розничном сайте Caroptics.ru. Здесь купить фары для своего автомобиля может любой желающий из любого региона России.</p><p>Мы находимся в Екатеринбурге и одинаково легко можем отправлять фары в Воронеж или Анадырь. <span class="read-more mobile">Читать полностью</span></p><div class="more-text desc"><p>Основное направление — это фары тайваньских производителей Depo, Sonar и Eagle eyes, а также противотуманные фары производства <b>DLAA</b> (Китай). Мы сделали ставку на хорошее качество и очень хорошую цену. <span class="read-less mobile">Скрыть</span></p></div></div><div class="content-pop-mark"><div class="entry-title"><h2 class="h3">Популярные марки</h2><a href="#" data-scroll=".content-all-mark" class="show-all">Посмотреть все</a></div><div class="pop-mark-wrapper"><?php $_smarty_tpl->tpl_vars['bestcellers_mark'] = new Smarty_variable(array('Mitsubishi','Toyota','Volkswagen','Chevrolet','Nissan','Ford','Kia','Opel','BMW','Hyundai'), null, 0);?><?php  $_smarty_tpl->tpl_vars['sub_cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub_cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub_cat']->key => $_smarty_tpl->tpl_vars['sub_cat']->value){
$_smarty_tpl->tpl_vars['sub_cat']->_loop = true;
?><?php if (in_array($_smarty_tpl->tpl_vars['sub_cat']->value['name'],$_smarty_tpl->tpl_vars['bestcellers_mark']->value)){?><div class="block"><a href="<?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['url'];?>
"><div class="img"><?php if ($_smarty_tpl->tpl_vars['sub_cat']->value['image']){?><img src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-data/public/shop/categories/<?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['id'];?>
<?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['image'];?>
"><?php }?></div><?php echo $_smarty_tpl->tpl_vars['sub_cat']->value['name'];?>
</a></div><?php }?><?php } ?></div></div><?php if ($_smarty_tpl->tpl_vars['category']->value['subcategories']){?><?php $_smarty_tpl->tpl_vars['subcategories'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['liter'] = new Smarty_variable('', null, 0);?><?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
$_smarty_tpl->tpl_vars['sc']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['f_liter'] = new Smarty_variable(strtoupper(substr($_smarty_tpl->tpl_vars['sc']->value['name'],0,1)), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('subcategories', null, 0);
$_smarty_tpl->tpl_vars['subcategories']->value[$_smarty_tpl->tpl_vars['f_liter']->value][] = $_smarty_tpl->tpl_vars['sc']->value;?><?php } ?><div class="content-all-mark"><div class="entry-title"><h2 class="h3">Все марки автомобилей</h2></div><div class="all-mark-wrapper"><ul class="marks"><?php  $_smarty_tpl->tpl_vars['liter_subcategories'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['liter_subcategories']->_loop = false;
 $_smarty_tpl->tpl_vars['f_liter'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['subcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['liter_subcategories']->key => $_smarty_tpl->tpl_vars['liter_subcategories']->value){
$_smarty_tpl->tpl_vars['liter_subcategories']->_loop = true;
 $_smarty_tpl->tpl_vars['f_liter']->value = $_smarty_tpl->tpl_vars['liter_subcategories']->key;
?><li class="dropdown"><a role="button" class='drop-sum closed'><?php echo $_smarty_tpl->tpl_vars['f_liter']->value;?>
</a><div class="drop-menu"><ul><?php  $_smarty_tpl->tpl_vars['lsc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lsc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liter_subcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lsc']->key => $_smarty_tpl->tpl_vars['lsc']->value){
$_smarty_tpl->tpl_vars['lsc']->_loop = true;
?><li><a href="<?php echo $_smarty_tpl->tpl_vars['lsc']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['lsc']->value['name'];?>
</a></li><?php } ?></ul></div></li><?php } ?></ul></div></div><?php }?><?php echo $_smarty_tpl->getSubTemplate ("working.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>