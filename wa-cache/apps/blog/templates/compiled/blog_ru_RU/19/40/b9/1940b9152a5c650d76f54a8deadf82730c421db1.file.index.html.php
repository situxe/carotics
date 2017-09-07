<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:37:13
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/index.html" */ ?>
<?php /*%%SmartyHeaderCode:175037036759b0e919338323-65721424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1940b9152a5c650d76f54a8deadf82730c421db1' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/index.html',
      1 => 1500633782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175037036759b0e919338323-65721424',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'canonical' => 0,
    'rss' => 0,
    'wa_theme_url' => 0,
    'w_theme_version' => 0,
    'wa_url' => 0,
    'action' => 0,
    'wa_active_theme_url' => 0,
    'wa_active_theme_path' => 0,
    'p' => 0,
    'cart_count' => 0,
    'cart_total' => 0,
    'page' => 0,
    'query' => 0,
    'wa_theme_version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e9194b0736_11808351',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e9194b0736_11808351')) {function content_59b0e9194b0736_11808351($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->title(), ENT_QUOTES, 'UTF-8', true);?>
</title>
    <meta name="Keywords" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->meta('keywords'), ENT_QUOTES, 'UTF-8', true);?>
" />
    <meta name="Description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wa']->value->meta('description'), ENT_QUOTES, 'UTF-8', true);?>
" />
    <?php if (!empty($_smarty_tpl->tpl_vars['canonical']->value)){?>
        <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['canonical']->value;?>
" />
    <?php }?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php if ($_smarty_tpl->tpl_vars['wa']->value->blog){?>
        <!-- rss -->
        <?php $_smarty_tpl->tpl_vars['rss'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->rssUrl(), null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['rss']->value){?>
            <link rel="alternate" type="application/rss+xml" title="<?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
" href="<?php echo $_smarty_tpl->tpl_vars['rss']->value;?>
">
        <?php }?>
    <?php }?>
    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/font.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/owl.carusel.2/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/owl.carusel.2/owl.theme.default.min.css">
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/jquery.formstyler.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/style.css?v<?php echo $_smarty_tpl->tpl_vars['w_theme_version']->value;?>
" rel="stylesheet">
    <?php if ($_smarty_tpl->tpl_vars['wa']->value->shop&&$_smarty_tpl->tpl_vars['wa']->value->shop->currency()=='RUB'){?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/font/ruble/arial/fontface.css" rel="stylesheet" type="text/css">
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['action']->value=='product'){?>
        <link href="<?php echo $_smarty_tpl->tpl_vars['wa_active_theme_url']->value;?>
js/fancybox3/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
    <?php }?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>
 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->js();?>
 

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <?php echo $_smarty_tpl->tpl_vars['wa']->value->head();?>
 
</head>
<body>
<div class="container-fluid site-wrapper">
    <div class="row delivery-row" style="display: none">
        <div class="container">
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/delivery-truck.png" alt="">
                <h4>Доставка по всей России</h4>
                <p>транспортными компаниями и Почтой России. <a href="#">Подробнее о доставке</a></p>
            </div>
            <div class="row-close">
                <p class=""><span>Закрыть</span> &times;</p>
            </div>
        </div>
    </div>
    <script>
        if (!localStorage.getItem("deliveryrow")) {
            $('.delivery-row').show();
        }
    </script>
    <div class="row navigation">
        <div class="container">
            <div class="menu-wrapper">
                <ul class="menu">
                    <li class="town">
                        <?php echo shopYoucityPlugin::getViewCity();?>

                    </li>
                    <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wa']->value->shop->pages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                        <li>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['p']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="row header">
        <div class="container">
            <div class="nav-iconcontainer">
                <div id="nav-icon" class="btn-default btn-link navbar-toggle collapsed">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
" class="header-logo">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logo.png" alt="">
                <p>Автооптика и кузовные запчасти с 2009 года</p>
            </a>
            <div class="header-phone">
                <a href="tel:8 (343) 339-42-09" class="phone">8 (343) 339-42-09</a>
                <p class="hrefs"><a href="#" class="res_header_phonenum">Обратный звонок</a> / <a href="#" class="res_header_phonenum">Написать письмо</a></p>
            </div>
            <div class="header-cabinet">
                <div class="box">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/my');?>
" class="cabinet">Личный кабинет</a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/myOrders');?>
" class="status">Статус заказа</a>
                </div>
            </div>
            <div class="header-cart">
                <div class="box">
                    <?php $_smarty_tpl->tpl_vars['cart_total'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->cart->total(), null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['cart_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->cart->count(), null, 0);?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/cart');?>
" class="cart">Корзина</a>
                    <p>Товаров: <span class="cart-count"><?php echo $_smarty_tpl->tpl_vars['cart_count']->value;?>
</span></p>
                    <p>На сумму: <span class="cart-total"><?php echo wa_currency_html($_smarty_tpl->tpl_vars['cart_total']->value,$_smarty_tpl->tpl_vars['wa']->value->shop->currency());?>
</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row cat-nav">
        <div class="container">
            <ul class="desc">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
catalog/optika/">Автомобильная оптика</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
catalog/komplekty_ptf/">Кузовные запчасти</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
catalog/avtolampy/">Автолампы</a></li>
            </ul>
            <ul class="mobile">
                <li><a href="catalog.html">Каталог</a></li>
                <li class="filter-btn"><a href="#">Выбор по автомобилю</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/cart');?>
">Корзина</a></li>
            </ul>
        </div>
    </div>
    <div class="row main<?php if ($_smarty_tpl->tpl_vars['action']->value=='category'){?> cat<?php }?>">
        <div class="container">
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wa_active_theme_path']->value)."/content.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
    </div>
    <div class="row footer">
        <div class="container">
            <div class="wrapper">
                <div class="footer-contacts">
                    <a href="tel:8 (343) 339-42-09" class="phone">8 (343) 339-42-09</a>
                    <div class="hrefs">
                        <a href="#" class="res_header_phonenum">Обратный звонок</a>
                        <a href="#" class="res_header_phonenum">Написать письмо</a>
                    </div>
                    <p class="work"><span>ПН-ПТ</span>: с 10:00 до 19:00 <br>
                        <span>СБ</span>: с 12:00 до 16:00</p>
                    <p class="address">Екатеринбург,<br>
                        ул. Черепанова, д. 23, 2 этаж
                    </p>
                </div>
                <div class="footer-menu">
                    <ul>
                        <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wa']->value->shop->pages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
                            <li>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['page']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="footer-hrefs">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
" class="footer-logo">
                        <img class='mobile' src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/logo-footer.png" alt="">
                        <img class="desc" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer-logo-desc.png" alt="">
                        <p class="mobile">Автомобильная оптика и кузовные запчасти с 2009 года</p>
                    </a>
                    <div class="social">
                        <a href="https://facebook.com"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/fb.png" alt=""></a>
                        <a href="https://vk.com"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/vk.png" alt=""></a>
                        <a href="https://instagram.com"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/insta.png" alt=""></a>
                        <a href="https://twitter.com"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/twitter.png" alt=""></a>
                        <a href="https://linkedin.com" class="mobile"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/in.png" alt=""></a>
                        <a href="https://google.com" class="mobile"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/footer/gplus.png" alt=""></a>
                    </div>
                </div>
                <div class="footer-search">
                    <p>Поиск по артикулу:</p>
                    <div class="search-form">
                        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('/frontend/search');?>
">
                            <input type="text" name="query" placeholder="Введите артикул товара..." <?php if (!empty($_smarty_tpl->tpl_vars['query']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
"<?php }?>>
                            <button type="submit"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row last">
        <div class="container">
            <a href="#" class="sitemap">Карта сайта</a>
            <p class="copyright">Copyright 2008 - <?php echo smarty_modifier_wa_datetime(time(),"Y");?>
</p>
            <div class="payment">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/visa.png" alt="">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/mastercard.png" alt="">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/something.png" alt="">
            </div>
        </div>
    </div>
</div>
<!--<div class="ontop">-->
<!--<a href="#top"><img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/ontop.png" alt=""/></a>-->
<!--</div>-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/owl.carusel.2/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/jquery.formstyler.min.js"></script>
<!--<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.validate.min.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.liLanding.js"></script>-->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
js/common.js?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
custom.shop.js?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
"></script>
<?php if ($_smarty_tpl->tpl_vars['action']->value=='product'){?>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_active_theme_url']->value;?>
js/fancybox3/jquery.fancybox.min.js?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
"></script>
<?php }?>
<div class="button_top_block">
    <a href="#" class="btn">Наверх</a>
</div>
</body>
</html><?php }} ?>