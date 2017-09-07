<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:49
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/home.html" */ ?>
<?php /*%%SmartyHeaderCode:120933508159b0e901d31bc9-00689948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5c929e3862d999e9631af139b32ca7cfe1771a3' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/home.html',
      1 => 1500875818,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120933508159b0e901d31bc9-00689948',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_url' => 0,
    'wa' => 0,
    'blog_posts' => 0,
    'post' => 0,
    'wa_theme_url' => 0,
    '_b' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e901e482a8_41885613',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e901e482a8_41885613')) {function content_59b0e901e482a8_41885613($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
?><div class="sidebar">
    <?php if (class_exists('shopSelectbycarPlugin')){?>
        <?php echo shopSelectbycarPlugin::display();?>

    <?php }?>
</div>
<div class="content">
    <div class="content-text">
        <p>Вы на розничном сайте Caroptics.ru. Здесь купить фары для своего автомобиля может любой желающий из любого региона России.</p>
        <p>Мы находимся в Екатеринбурге и одинаково легко можем отправлять фары в Воронеж или Анадырь. <span class="read-more mobile">Читать дальше</span></p>
        <div class="more-text desc">
            <p>Основное направление — это фары тайваньских производителей Depo, Sonar и Eagle eyes, а также противотуманные фары производства <b>DLAA</b> (Китай). Мы сделали ставку на хорошее качество и очень хорошую цену.</p>
        </div>
        <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
catalog/optika/" class="btn">Перейти в каталог оптики</a>
    </div>
    <div class="content-news">
        <div class="entry-title">
            <h2 class="h3">Новости Caroptics.ru</h2>
            <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
blog/" class="show-all">Посмотреть все</a>
        </div>
        <div class="news-wrapper">
            <?php $_smarty_tpl->tpl_vars['blog_posts'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->posts(null,2), null, 0);?>
            <?php if (count($_smarty_tpl->tpl_vars['blog_posts']->value)){?>
                <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blog_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                    <div class="block">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="title"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
                        <p class="date-time"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],'Y.m.d H:i:s');?>
</p>
                        <div class="text">
                            <?php echo smarty_modifier_truncate(strip_tags($_smarty_tpl->tpl_vars['post']->value['text']),128);?>

                        </div>
                    </div>
                <?php } ?>
            <?php }?>
        </div>
    </div>
    <div class="content-popular">
        <div class="entry-title">
            <h2 class="h3">Популярные виды запчастей</h2>
            <a href="#" class="show-all">Посмотреть все</a>
        </div>
        <div class="popular-wrapper">
            <div class="block">
                <div class="img"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/1.jpg" alt=""></div>
                <a href="#">Передние фары</a>
            </div>
            <div class="block">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/2.jpg" alt="">
                </div>
                <a href="#">Передние крылья</a>
            </div>
            <div class="block">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/3.jpg" alt="">
                </div>
                <a href="#">Лампы H7</a>
            </div>
            <div class="block">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/4.jpg" alt="">
                </div>
                <a href="#">Боковые зеркала</a>
            </div>
            <div class="block">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/5.jpg" alt="">
                </div>
                <a href="#">Тюнинг фары</a>
            </div>
            <div class="block">
                <div class="img">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/popular/6.jpg" alt="">
                </div>
                <a href="#">Противотуманные фары</a>
            </div>
        </div>
    </div>
    <div class="content-details">
        <div class="entry-title">
            <h2 class="h3">Запчасти для популярных автомобилей</h2>
            <a href="#" class="show-all">Посмотреть все</a>
        </div>
        <div class="details-wrapper">
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Mitsubishi_logo.png" alt="">
                <a href="#">Задние фонари Mitsubishi Pajero Sport (2009-)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/logo-Toyota.png" alt="">
                <a href="#">Тюнинг фары Toyota Camry V40 (2006-2011)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Volkswagen.png" alt="">
                <a href="#">Противотуманные фары Volkswagen Jetta 5 (2005-2010)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Nissan-logo.png" alt="">
                <a href="#">Решетки радиатора Nissan Note (2006-2009)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Ford-logo.png" alt="">
                <a href="#">Фары Ford Focus 2 (2008-2010) рестайлинг</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Chevrolet_logo.png" alt="">
                <a href="#">Фары Chevrolet Lacetti (2004-2013) хэтчбек</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Nissan-logo.png" alt="">
                <a href="#">Комплекты противотуманок Nissan Juke (2011- )</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Ford-logo.png" alt="">
                <a href="#">Ходовые огни Ford Focus 3 (2011-2014)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Chevrolet_logo.png" alt="">
                <a href="#">Противотуманные фары Chevrolet Captiva (2006-2011)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Opel-logo.png" alt="">
                <a href="#">Противотуманные фары Opel Astra H (2004-2014)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/Opel-logo.png" alt="">
                <a href="#">Зеркала Opel Mokka (2012-)</a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logos/kia.png" alt="">
                <a href="#">Тюнинг фары Kia Rio 3 (2011-2014)</a>
            </div>
        </div>
    </div>
    <div class="content-brands">
        <div class="entry-title">
            <h2 class="h3">Лучшие производители</h2>
            <a href="#" class="show-all">Посмотреть все</a>
        </div>
        <div class="brands-wrapper owl-carousel brands-carousel">
            <?php  $_smarty_tpl->tpl_vars['_b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_b']->_loop = false;
 $_from = shopProductbrandsPlugin::getBrands(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_b']->key => $_smarty_tpl->tpl_vars['_b']->value){
$_smarty_tpl->tpl_vars['_b']->_loop = true;
?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_b']->value['url'];?>
">
                    <div class="block">
                        <?php if ($_smarty_tpl->tpl_vars['_b']->value['image']){?><img src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-data/public/shop/brands/<?php echo $_smarty_tpl->tpl_vars['_b']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['_b']->value['id'];?>
<?php echo $_smarty_tpl->tpl_vars['_b']->value['image'];?>
"><?php }?>
                    </div>
                </a>
            <?php } ?>
            
            <div class="block">
                <a href="#">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/brand/2.png" alt="">
                </a>
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/brand/3.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/brand/4.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/brand/5.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/brand/6.png" alt="">
            </div>
        </div>
    </div>
    <div class="content-how">
        <div class="entry-title">
            <h2 class="h3">Как мы работаем</h2>
        </div>
        <div class="how-wrapper">
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/1.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/1-hover.png" alt="">
                </div>
                <p>Бесплатно дополнительно упаковываем</p>
            </div>
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/2.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/2-hover.png" alt="">
                </div>
                <p>Бесплатная доставка до транспортной компании</p>
            </div>
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/3.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/3-hover.png" alt="">
                </div>
                <p>Бесплатное почтовое оформление</p>
            </div>
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/4.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/4-hover.png" alt="">
                </div>
                <p>Возврат в течение<br> 31 дня после оформления</p>
            </div>
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/5.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/5-hover.png" alt="">
                </div>
                <p>Точный расчет перевозки на сайте</p>
            </div>
            <div class="block">
                <div class="img">
                    <img class="standart" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/6.png" alt="">
                    <img class="hover" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/icos/6-hover.png" alt="">
                </div>
                <p>Действительно много способов оплаты</p>
            </div>
        </div>
    </div>
</div><?php }} ?>