<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:50
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/youcity/templates/YoucityWindow.html" */ ?>
<?php /*%%SmartyHeaderCode:53827897659b0e90253bf39-12748854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc1f9084cc867f7a8281fa2c3c918de9b99bead9' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/youcity/templates/YoucityWindow.html',
      1 => 1470220184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53827897659b0e90253bf39-12748854',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'country' => 0,
    'k' => 0,
    'v' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e9025abc81_63049511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e9025abc81_63049511')) {function content_59b0e9025abc81_63049511($_smarty_tpl) {?><div id="city_win" style="display: none;">
        <div class="grey_bg"></div>
        <div class="youcity_content">
            
            <h5>Где вы находитесь?</h5>
            <?php if ($_smarty_tpl->tpl_vars['info']->value&&$_smarty_tpl->tpl_vars['country']->value){?>
              <?php if (count($_smarty_tpl->tpl_vars['country']->value)>1){?>
                <ul class="country-changer">
                    <li <?php if (!in_array('rus',$_smarty_tpl->tpl_vars['country']->value)){?> style="display:none;" <?php }?> class="rus active" data-youcity="rus"><a ><i></i>Россия </a></li>
                    <li <?php if (!in_array('ukr',$_smarty_tpl->tpl_vars['country']->value)){?> style="display:none;" <?php }?> class="ukr" data-youcity="ukr"><a ><i></i>Украина</a></li>
                    <li <?php if (!in_array('kaz',$_smarty_tpl->tpl_vars['country']->value)){?> style="display:none;" <?php }?> class="kaz" data-youcity="kaz"><a ><i></i>Казахстан </a></li>
                    <li <?php if (!in_array('blr',$_smarty_tpl->tpl_vars['country']->value)){?> style="display:none;" <?php }?> class="blr" data-youcity="blr"><a ><i></i>Белоруссия </a></li>
                </ul>
               <?php }?>
            <div class="city-changer">
                <span>Выбор города</span>
                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                <ul class="city_list" data-youcitylist="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
">
                    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['v']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
?>
                    <li><a data-region="<?php echo $_smarty_tpl->tpl_vars['value']->value['region'];?>
" data-country="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" href=""><span id="city_active"><?php echo $_smarty_tpl->tpl_vars['value']->value['city'];?>
</span></a></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
            <?php }?>
            <div class="auto-city">
                <h6><?php if ($_smarty_tpl->tpl_vars['info']->value&&$_smarty_tpl->tpl_vars['country']->value){?>Другой город?<?php }else{ ?>&nbsp;<?php }?></h6>
                <div class="auto-city-input">
                <input type="text" name="youcity" title="Введите название города" placeholder="Введите название города" />
                    <ul id="find_city" style="display: none;">
                    </ul>
                </div>
            </div>            
            <span class="youcity-close"></span>
        </div>
        
</div>
<?php }} ?>