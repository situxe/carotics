<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:42:04
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:167755126459b0ea3c3a2987-71164989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba8909541a6f331267d881e9ae6d75855e20eb02' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/sidebar.html',
      1 => 1504590750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167755126459b0ea3c3a2987-71164989',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'filters' => 0,
    'theme_settings' => 0,
    'wa' => 0,
    'fid' => 0,
    'filter' => 0,
    'c' => 0,
    '_v' => 0,
    'v_id' => 0,
    'v' => 0,
    'wa_app_url' => 0,
    'wa_theme_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0ea3c5b6668_09256507',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0ea3c5b6668_09256507')) {function content_59b0ea3c5b6668_09256507($_smarty_tpl) {?><div class="sidebar mini">
    <?php if (class_exists('shopSelectbycarPlugin')){?>
        <?php echo shopSelectbycarPlugin::display();?>

    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['category']->value['id']!=558){?>
        <?php if (!empty($_smarty_tpl->tpl_vars['filters']->value)){?>
            <div class="side-filter desc side-add">
                <h3>Фильтр товаров</h3>
                <div class="filters<?php if (!empty($_smarty_tpl->tpl_vars['theme_settings']->value['ajax_filters'])){?> ajax<?php }?>">
                    <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['wa']->value->currentUrl(0,1);?>
">
                        <?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['filter']->_loop = false;
 $_smarty_tpl->tpl_vars['fid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value){
$_smarty_tpl->tpl_vars['filter']->_loop = true;
 $_smarty_tpl->tpl_vars['fid']->value = $_smarty_tpl->tpl_vars['filter']->key;
?>
                            <p>
                            <?php if ($_smarty_tpl->tpl_vars['fid']->value=='price'){?>
                                <?php $_smarty_tpl->tpl_vars['c'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->currency(true), null, 0);?>
                                <b>Цена</b>
                                <br>
                                от
                                <input type="text" name="price_min" <?php if ($_smarty_tpl->tpl_vars['wa']->value->get('price_min')){?>value="<?php echo (int)$_smarty_tpl->tpl_vars['wa']->value->get('price_min');?>
"<?php }?> placeholder="<?php echo floor($_smarty_tpl->tpl_vars['filter']->value['min']);?>
">
                                до
                                <input type="text" name="price_max" <?php if ($_smarty_tpl->tpl_vars['wa']->value->get('price_max')){?>value="<?php echo (int)$_smarty_tpl->tpl_vars['wa']->value->get('price_max');?>
"<?php }?> placeholder="<?php echo ceil($_smarty_tpl->tpl_vars['filter']->value['max']);?>
">
                                <?php echo $_smarty_tpl->tpl_vars['c']->value['sign'];?>

                            <?php }else{ ?>
                                <?php if ($_smarty_tpl->tpl_vars['fid']->value!=4){?>
                                    <b><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</b>
                                    <br>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['filter']->value['type']=='boolean'){?>
                                    <label><input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
"<?php if ($_smarty_tpl->tpl_vars['wa']->value->get($_smarty_tpl->tpl_vars['filter']->value['code'])){?> checked<?php }?> value="1"> Да</label>
                                    <br>
                                    <label><input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
"<?php if ($_smarty_tpl->tpl_vars['wa']->value->get($_smarty_tpl->tpl_vars['filter']->value['code'])==='0'){?> checked<?php }?> value="0"> Нет</label>
                                    <br>
                                    <label><input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
"<?php if ($_smarty_tpl->tpl_vars['wa']->value->get($_smarty_tpl->tpl_vars['filter']->value['code'],'')===''){?> checked<?php }?> value=""> Неважно</label>
                                    <br>
                                <?php }elseif(isset($_smarty_tpl->tpl_vars['filter']->value['min'])){?>
                                    <?php $_smarty_tpl->tpl_vars['_v'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->get($_smarty_tpl->tpl_vars['filter']->value['code']), null, 0);?>
                                    от
                                    <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
[min]" placeholder="<?php echo $_smarty_tpl->tpl_vars['filter']->value['min'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['_v']->value['min'])){?>value="<?php echo $_smarty_tpl->tpl_vars['_v']->value['min'];?>
"<?php }?>>
                                    до
                                    <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
[max]" placeholder="<?php echo $_smarty_tpl->tpl_vars['filter']->value['max'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['_v']->value['max'])){?>value="<?php echo $_smarty_tpl->tpl_vars['_v']->value['max'];?>
"<?php }?>>
                                    <?php if (!empty($_smarty_tpl->tpl_vars['filter']->value['unit'])){?>
                                        <?php echo $_smarty_tpl->tpl_vars['filter']->value['unit']['title'];?>

                                        <?php if ($_smarty_tpl->tpl_vars['filter']->value['unit']['value']!=$_smarty_tpl->tpl_vars['filter']->value['base_unit']['value']){?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
[unit]" value="<?php echo $_smarty_tpl->tpl_vars['filter']->value['unit']['value'];?>
"><?php }?>
                                    <?php }?>
                                <?php }else{ ?>
                                    <ul>
                                        <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['v_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['v_id']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                            <li>
                                                <input id="filter-<?php echo $_smarty_tpl->tpl_vars['fid']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['v_id']->value;?>
" type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['filter']->value['code'];?>
[]" <?php if (in_array($_smarty_tpl->tpl_vars['v_id']->value,(array)$_smarty_tpl->tpl_vars['wa']->value->get($_smarty_tpl->tpl_vars['filter']->value['code'],array()))){?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['v_id']->value;?>
">
                                                <label for="filter-<?php echo $_smarty_tpl->tpl_vars['fid']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['v_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php }?>
                            <?php }?>
                            </p>
                        <?php } ?>

                        <?php if ($_smarty_tpl->tpl_vars['wa']->value->get('sort')){?><input type="hidden" name="sort" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->get('sort'), ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['wa']->value->get('order')){?><input type="hidden" name="order" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->get('order'), ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
                        <?php if (empty($_smarty_tpl->tpl_vars['theme_settings']->value['ajax_filters'])){?><input type="submit" value="Показать"><?php }?>
                    </form>
                </div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
catalog/<?php echo $_smarty_tpl->tpl_vars['category']->value['url'];?>
" class="all" id="reset_filter">Посмотреть все запчасти <br><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a>
            </div>
        <?php }?>
        <div class="desc side-add quick">
            <h3>Быстрый фильтр по типу запчасти для Honda Civic 4D</h3>
            <ul>
                <li><a href="#">Фары</a></li>
                <li><a href="#">Тюнинг фары</a></li>
                <li><a href="#">Противотуманные фары</a></li>
                <li><a href="#">Комплекты противотуманок</a></li>
                <li><a href="#">Задние фонари</a></li>
                <li><a href="#">Тюнинг фонари</a></li>
                <li><a href="#">Стекла противотуманок</a></li>
                <li><a href="#">Бамперы передние</a></li>
            </ul>
        </div>
    <?php }else{ ?>
        <div class="side-popular desc side-add">
            <h3>Популярные модели</h3>
            <ul>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/1.png" alt=""> <a href="#">Mitsubishi Pajero Sport (2009 - )</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/2.png" alt=""> <a href="#">Toyota Camry V40 (2006 - 2011)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/3.png" alt=""> <a href="#">Ford Focus 2 (2008 - 2010) рестайлинг</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/4.png" alt=""> <a href="#">Chevrolet Captiva (2006 - 2011)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/1.png" alt=""> <a href="#">Opel Astra H (2004 - 2014)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/2.png" alt=""> <a href="#">Volkswagen Jetta 5 (2005 - 2010)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/3.png" alt=""> <a href="#">Nissan Note (2006 - 2009)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/4.png" alt=""> <a href="#">Ford Focus 3 (2011 - 2014)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/1.png" alt=""> <a href="#">Opel Mokka (2012 - )</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/2.png" alt=""> <a href="#">Mitsubishi Lancer 9 (2003 - 2009)</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/3.png" alt=""> <a href="#">Chevrolet Lacetti (2004 - 2013) хэтчбек</a></li>
                <li><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mini/4.png" alt=""> <a href="#">Nissan Juke (2011 - )</a></li>
            </ul>
        </div>
    <?php }?>
</div>

<!-- plugin hook: 'frontend_nav' -->


<!-- plugin hook: 'frontend_nav_aux' -->


<?php }} ?>