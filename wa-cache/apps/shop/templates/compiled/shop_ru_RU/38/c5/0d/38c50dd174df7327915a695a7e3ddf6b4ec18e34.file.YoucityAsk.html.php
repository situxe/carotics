<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:50
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/youcity/templates/YoucityAsk.html" */ ?>
<?php /*%%SmartyHeaderCode:118097486659b0e9025b65a7-37471592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38c50dd174df7327915a695a7e3ddf6b4ec18e34' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/youcity/templates/YoucityAsk.html',
      1 => 1470220184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118097486659b0e9025b65a7-37471592',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e9025b8776_68359663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e9025b8776_68359663')) {function content_59b0e9025b8776_68359663($_smarty_tpl) {?><div class="Youcity_ask">
    <div class="wrap_youcity_ask">
        <div class="main-h6">Угадали?</div>
        <div class="button-wrap"> 
            <a href="#" class="c-button Youcity_close myYouButton" onclick="hideYoucityAsk();addYoucity();return false;" > Да </a>
            <a href="#" onclick="hideYoucityAsk();showYoucityList();return false;" class="Youcity_fancy Youcity_fancy_all c-button myYouButton"> Нет </a>
        </div>
    </div>
</div><?php }} ?>