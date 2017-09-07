<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:35
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.html" */ ?>
<?php /*%%SmartyHeaderCode:8500231859b0eb0f5884d2-64794321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5aff6329c58d1acf52d2bbf7770bb8f43359c6a3' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.html',
      1 => 1504606683,
      2 => 'file',
    ),
    '38934de17c59abe61c6d7f1c474a16f9c2000b99' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.cart.html',
      1 => 1500876670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8500231859b0eb0f5884d2-64794321',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_theme_url' => 0,
    'product' => 0,
    'image' => 0,
    'wa' => 0,
    'f_code' => 0,
    'features' => 0,
    'f_value' => 0,
    'max_feature' => 0,
    'upselling' => 0,
    'wa_app_url' => 0,
    'category_product' => 0,
    'crossselling' => 0,
    'wa_app_static_url' => 0,
    'reviews' => 0,
    'review' => 0,
    'reviews_total_count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb0fb5cb13_64339563',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb0fb5cb13_64339563')) {function content_59b0eb0fb5cb13_64339563($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><?php echo $_smarty_tpl->getSubTemplate ("breadcrumb.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link href="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
css/jquery.formstyler.css" rel="stylesheet">
<div class="product-content">
    <div class="entry-title entry-header">
        <?php echo $_smarty_tpl->getSubTemplate ("soc-widget.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <h2><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</h2>
    </div>
    <div class="product-info">
        <div class="product-gallery">
            <div class="img">
                <div class="gallery_main <?php if (count($_smarty_tpl->tpl_vars['product']->value['images'])>1){?>owl-carousel<?php }?>">
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['images']){?>
                        <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->imgUrl(array('id'=>$_smarty_tpl->tpl_vars['image']->value['id'],'product_id'=>$_smarty_tpl->tpl_vars['product']->value['id'],'ext'=>$_smarty_tpl->tpl_vars['image']->value['ext'],'filename'=>$_smarty_tpl->tpl_vars['image']->value['filename']),'950');?>
" data-fancybox="product-gallery">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->imgUrl(array('id'=>$_smarty_tpl->tpl_vars['image']->value['id'],'product_id'=>$_smarty_tpl->tpl_vars['product']->value['id'],'ext'=>$_smarty_tpl->tpl_vars['image']->value['ext'],'filename'=>$_smarty_tpl->tpl_vars['image']->value['filename']),'388');?>
">
                            </a>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->productImgHtml($_smarty_tpl->tpl_vars['product']->value,'388',array('itemprop'=>'image','alt'=>$_smarty_tpl->tpl_vars['product']->value['name'],'default'=>((string)$_smarty_tpl->tpl_vars['wa_theme_url']->value)."img/dummy200.png"));?>

                    <?php }?>
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['images']){?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/real.png" alt="" class="real">
            <?php }?>
            <?php if (count($_smarty_tpl->tpl_vars['product']->value['images'])>1){?>
                <div class="owl owl-carousel">
                    <?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
                        <?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->imgHtml(array('id'=>$_smarty_tpl->tpl_vars['image']->value['id'],'product_id'=>$_smarty_tpl->tpl_vars['product']->value['id'],'ext'=>$_smarty_tpl->tpl_vars['image']->value['ext'],'filename'=>$_smarty_tpl->tpl_vars['image']->value['filename']),'388',array('alt'=>$_smarty_tpl->tpl_vars['product']->value['name'],'title'=>$_smarty_tpl->tpl_vars['product']->value['name']));?>

                    <?php } ?>
                </div>
            <?php }?>
        </div>
        <div class="product-details">
            <div class="tech mobile">
                <p>
                    <?php  $_smarty_tpl->tpl_vars['f_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f_value']->_loop = false;
 $_smarty_tpl->tpl_vars['f_code'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['f_value']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['f_value']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['f_value']->key => $_smarty_tpl->tpl_vars['f_value']->value){
$_smarty_tpl->tpl_vars['f_value']->_loop = true;
 $_smarty_tpl->tpl_vars['f_code']->value = $_smarty_tpl->tpl_vars['f_value']->key;
 $_smarty_tpl->tpl_vars['f_value']->iteration++;
 $_smarty_tpl->tpl_vars['f_value']->last = $_smarty_tpl->tpl_vars['f_value']->iteration === $_smarty_tpl->tpl_vars['f_value']->total;
?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['name'], ENT_QUOTES, 'UTF-8', true);?>
:&nbsp;<?php if (is_array($_smarty_tpl->tpl_vars['f_value']->value)){?><?php if ($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['type']=='color'){?><?php echo implode('<br /> ',$_smarty_tpl->tpl_vars['f_value']->value);?>
<?php }else{ ?><?php echo implode(', ',$_smarty_tpl->tpl_vars['f_value']->value);?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['f_value']->value;?>
<?php }?><?php if (!$_smarty_tpl->tpl_vars['f_value']->last){?>,&nbsp;<?php }?><?php } ?>
                </p>
            </div>
            <?php /*  Call merged included template "product.cart.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("product.cart.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '8500231859b0eb0f5884d2-64794321');
content_59b0eb0f6a3181_82312919($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "product.cart.html" */?>
            <div class="tech-detail desc">
                <div class="table-info">
                    <?php $_smarty_tpl->tpl_vars['max_feature'] = new Smarty_variable(8, null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars['f_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f_value']->_loop = false;
 $_smarty_tpl->tpl_vars['f_code'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['f_value']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['f_value']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['f_value']->key => $_smarty_tpl->tpl_vars['f_value']->value){
$_smarty_tpl->tpl_vars['f_value']->_loop = true;
 $_smarty_tpl->tpl_vars['f_code']->value = $_smarty_tpl->tpl_vars['f_value']->key;
 $_smarty_tpl->tpl_vars['f_value']->iteration++;
 $_smarty_tpl->tpl_vars['f_value']->last = $_smarty_tpl->tpl_vars['f_value']->iteration === $_smarty_tpl->tpl_vars['f_value']->total;
?>
                        <?php if ($_smarty_tpl->tpl_vars['f_value']->iteration>$_smarty_tpl->tpl_vars['max_feature']->value){?>
                            <?php break 1?>
                        <?php }?>
                        <div <?php if ($_smarty_tpl->tpl_vars['f_value']->iteration>$_smarty_tpl->tpl_vars['max_feature']->value){?>class="feature_show_hide" style="display: none"<?php }?>>
                            <p class="dotted"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['name'], ENT_QUOTES, 'UTF-8', true);?>
</span></p>
                            <p>
                                <?php if (is_array($_smarty_tpl->tpl_vars['f_value']->value)){?>
                                    <?php if ($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['type']=='color'){?>
                                        <?php echo implode('<br /> ',$_smarty_tpl->tpl_vars['f_value']->value);?>

                                    <?php }else{ ?>
                                        <?php echo implode(', ',$_smarty_tpl->tpl_vars['f_value']->value);?>

                                    <?php }?>
                                <?php }else{ ?>
                                    <?php echo $_smarty_tpl->tpl_vars['f_value']->value;?>

                                <?php }?>
                            </p>
                        </div>
                    <?php } ?>
                    <?php if (count($_smarty_tpl->tpl_vars['product']->value['features'])>$_smarty_tpl->tpl_vars['max_feature']->value){?>
                        <span class="green-href feature_show_all" data-scroll=".detailed-info">Все характеристики</span>
                    <?php }?>
                </div>
                <div class="delivery-info">
                    <div class="block">
                        <div class="img">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/delivery1.png" alt="">
                        </div>
                        <div class="text">
                            <p>Заказ можно забрать самостоятельно</p>
                            <a href="#" class="green-href">Самовывоз</a>
                        </div>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/delivery2.png" alt="">
                        </div>
                        <div class="text">
                            <p>Всегда дополнительно упаковываем </p>
                            <a href="#" class="green-href">Как заказ доедет целым?</a>
                        </div>
                    </div>
                    <div class="block">
                        <div class="img">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/delivery3.png" alt="">
                        </div>
                        <div class="text">
                            <p>Принимаем возврат в течение 14 дней после получения</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->getSubTemplate ("working_shipping.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php $_smarty_tpl->tpl_vars['category_product'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->category($_smarty_tpl->tpl_vars['product']->value['category_id']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['upselling'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value->upSelling(12), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['upselling']->value){?>
        <div class="related drop">
            <div class="entry-title">
                <h3 data-target="#id1" class="accord">С <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 часто покупают</h3>
                <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
catalog/<?php echo $_smarty_tpl->tpl_vars['category_product']->value['url'];?>
" class="show-all desc">Посмотреть все запчасти на <?php echo $_smarty_tpl->tpl_vars['category_product']->value['name'];?>
</a>
            </div>
            <div id="id1" class="acc-target">
                <div class="owl-related ">
                    <?php echo $_smarty_tpl->getSubTemplate ("product.list.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['upselling']->value), 0);?>

                </div>
            </div>
        </div>
    <?php }?>

    <?php $_smarty_tpl->tpl_vars['crossselling'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value->crossSelling(12), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['crossselling']->value){?>
        <div class="related drop">
            <div class="entry-title">
                <h3 data-target="#id1" class="accord">С <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
 часто покупают</h3>
                <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
catalog/<?php echo $_smarty_tpl->tpl_vars['category_product']->value['url'];?>
" class="show-all desc">Посмотреть все запчасти на <?php echo $_smarty_tpl->tpl_vars['category_product']->value['name'];?>
</a>
            </div>
            <div id="id1" class="acc-target">
                <div class="owl-carousel product_list_slider">
                    <?php echo $_smarty_tpl->getSubTemplate ("product.list.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('products'=>$_smarty_tpl->tpl_vars['crossselling']->value), 0);?>

                </div>
            </div>
        </div>
    <?php }?>
    <div class="detailed-info drop">
        <div class="entry-title">
            <h3 data-target="#id2" class="accord">Технические характеристики <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</h3>
        </div>
        <div class="detailed acc-target" id="id2">
            <div class="w50">
                <?php  $_smarty_tpl->tpl_vars['f_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f_value']->_loop = false;
 $_smarty_tpl->tpl_vars['f_code'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['f_value']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['f_value']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['f_value']->key => $_smarty_tpl->tpl_vars['f_value']->value){
$_smarty_tpl->tpl_vars['f_value']->_loop = true;
 $_smarty_tpl->tpl_vars['f_code']->value = $_smarty_tpl->tpl_vars['f_value']->key;
 $_smarty_tpl->tpl_vars['f_value']->iteration++;
 $_smarty_tpl->tpl_vars['f_value']->last = $_smarty_tpl->tpl_vars['f_value']->iteration === $_smarty_tpl->tpl_vars['f_value']->total;
?>
                    <div>
                        <p class="dotted"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['name'], ENT_QUOTES, 'UTF-8', true);?>
</span></p>
                        <p>
                            <?php if (is_array($_smarty_tpl->tpl_vars['f_value']->value)){?>
                                <?php if ($_smarty_tpl->tpl_vars['features']->value[$_smarty_tpl->tpl_vars['f_code']->value]['type']=='color'){?>
                                    <?php echo implode('<br /> ',$_smarty_tpl->tpl_vars['f_value']->value);?>

                                <?php }else{ ?>
                                    <?php echo implode(', ',$_smarty_tpl->tpl_vars['f_value']->value);?>

                                <?php }?>
                            <?php }else{ ?>
                                <?php echo $_smarty_tpl->tpl_vars['f_value']->value;?>

                            <?php }?>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="w50">
                <div>
                    <p class="dotted"><span>Артикулы для замены:</span></p>
                    <p>217-1159L-LDEM2, 313-1111L-HS, 33101S2HG01, 217-1159L-LDEM2, 217-1159L-LDEM2, 313-1111L-HS, 33101S2HG01</p>
                </div>
                <div>
                    <p class="dotted"><span>Оригинальные артикулы:</span></p>
                    <p>217-1159L-LDEM2, 33101S2HG01, 313-1111L-HS, 313-1111L-HS</p>
                </div>
                <div>
                    <p class="dotted"><span>В продаже:</span></p>
                    <p>с 2009 года</p>
                </div>
            </div>
        </div>
    </div>

    <?php echo $_smarty_tpl->getSubTemplate ("product.delivery.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <div class="payment-info">
        <div class="entry-title">
            <h3>Способы оплаты</h3>
        </div>
        <div class="payment-type">
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/payments/1.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/payments/2.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/payments/3.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/payments/4.png" alt="">
            </div>
            <div class="block">
                <img src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
img/payments/5.png" alt="">
            </div>
        </div>
    </div>
    <div class="reaction-info desc">
        <div class="entry-title">
            <h3>Вопросы и отзывы по фаре <?php echo $_smarty_tpl->tpl_vars['category_product']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</h3>
        </div>
        <div class="reactions">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Вопрос - ответ (5)</a></li>
                <li><a href="#tab2" role="tab" data-toggle="tab">Отзывы (13)</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="tab-info">
                        <p>Здесь можно задать вопрос по данному товару, например, о комплектности, совместимости, особенностях или других нюансах.
                            Вопросы о доставке, сроках поступления правильно задавать <a href="#" class="green-href">здесь</a>.</p>
                        <p>ВНИМАНИЕ! Если вы хотите получить ответ на свой вопрос, укажите адрес электронной почты.</p>
                        <button class="btn">Задать вопрос</button>
                    </div>
                    <div class="faq">
                        <div class="item">
                            <div class="question">
                                <p><span class="name">Василий</span> <span class="date">23.03.17</span></p>
                                <p class="quest-txt">Кнопка двойная или одинарная и включает сразу передние ПТФ и задние ПТФ?</p>
                            </div>
                            <div class="answer">
                                <p class="title">Ответ от <span>Caroptics.ru</span>:</p>
                                <p>Одинарная, она такая как у вас, т.е. включает задние. Чтобы включались передние нужна чать проводки по бамперу, реле и
                                    двойная кнопка. Либо можно проложить проводку из комплекта дополнительно.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="question">
                                <p><span class="name">Василий</span> <span class="date">23.03.17</span></p>
                                <p class="quest-txt">Кнопка двойная или одинарная и включает сразу передние ПТФ и задние ПТФ?</p>
                            </div>
                            <div class="answer">
                                <p class="title">Ответ от <span>Caroptics.ru</span>:</p>
                                <p>Одинарная, она такая как у вас, т.е. включает задние. Чтобы включались передние нужна чать проводки по бамперу, реле и
                                    двойная кнопка. Либо можно проложить проводку из комплекта дополнительно.</p>
                            </div>
                        </div>
                        <button class="btn">Задать вопрос</button>
                    </div>
                </div>
                <div class="tab-pane" id="tab2">
                    <script type="text/javascript">
                        $(function () {
                            var loading = $('<div><i class="icon16 loading"></i>Loading...</div>');
                            $('#tab2').html(loading);
                            $.post('<?php echo $_smarty_tpl->tpl_vars['wa']->value->currentUrl();?>
reviews/', {
                                random: "1"
                            }, function (html) {
                                $('#tab2').html($(html).find('.reviews')[0].outerHTML);
                                $('#tab2').prepend('<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/rate.widget.js"><\/script>').prepend('<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
reviews.js"><\/script>').find('.loading').parent().remove();
                                $('div.wa-captcha .wa-captcha-refresh, div.wa-captcha .wa-captcha-img').unbind('click').click(function () {
                                    var div = $(this).parents('div.wa-captcha');
                                    var captcha = div.find('.wa-captcha-img');
                                    if (captcha.length) {
                                        captcha.attr('src', captcha.attr('src').replace(/\?.*$/, '?rid=' + Math.random()));
                                        captcha.one('load', function () {
                                            //div.find('.wa-captcha-input').focus();
                                        });
                                    }
                                    ;
                                    div.find('input').val('');
                                    return false;
                                });
                            });
                        });
                    </script>
                    <div class="tab-info">
                        <br>
                        <a href="reviews/" style="    position: relative;bottom: 0" class="btn">Написать отзыв</a>
                    </div>
                    <h3><?php echo sprintf('%s отзывы',htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true));?>
</h3>
                    <div class="faq">
                        <?php  $_smarty_tpl->tpl_vars['review'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['review']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['reviews']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['review']->key => $_smarty_tpl->tpl_vars['review']->value){
$_smarty_tpl->tpl_vars['review']->_loop = true;
?>
                            <div class="item">
                                <div class="question">
                                    <p><span class="name"><?php echo $_smarty_tpl->tpl_vars['review']->value['author']['name'];?>
</span> <span class="date"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['review']->value['datetime'],"humandate");?>
</span></p>
                                    <p class="quest-txt"><?php echo $_smarty_tpl->tpl_vars['review']->value['text'];?>
</p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="count_url_review">
                        <?php if (!$_smarty_tpl->tpl_vars['reviews']->value){?>
                            <p><?php echo sprintf('Оставьте <a href="%s">отзыв об этом товаре</a> первым!','reviews/');?>
</p>
                        <?php }else{ ?>
                            <?php echo sprintf(_w('Read <a href="%s">all %d review</a> on %s','Read <a href="%s">all %d reviews</a> on %s',$_smarty_tpl->tpl_vars['reviews_total_count']->value,false),'reviews/',$_smarty_tpl->tpl_vars['reviews_total_count']->value,htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true));?>

                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="react-reviews mobile drop">
        <div class="entry-title">
            <h3 data-target="#id4" class="accord">Отзывы по фаре Honda Civic 4D (2006-2012) - 217-1159L-LDEM2</h3>
        </div>
        <div class="entry-content acc-target" id="id4">
            <div class="wrapper">
                <p>Дизайн для отзывов в макете отстутствует.</p>
            </div>
        </div>
    </div>
    <div class="react-questions mobile drop">
        <div class="entry-title">
            <h3 data-target="#id5" class="accord">Вопросы по фаре Honda Civic 4D (2006-2012) - 217-1159L-LDEM2</h3>
        </div>
        <div class="entry-content acc-target" id="id5">
            <div class="wrapper">
                <div class="faq">
                    <div class="item">
                        <div class="question">
                            <p><span class="name">Василий</span> <span class="date">23.03.17</span></p>
                            <p class="quest-txt">Кнопка двойная или одинарная и включает сразу передние ПТФ и задние ПТФ?</p>
                        </div>
                        <div class="answer">
                            <p class="title">Ответ от <span>Caroptics.ru</span>:</p>
                            <p>Одинарная, она такая как у вас, т.е. включает задние. Чтобы включались передние нужна чать проводки по бамперу, реле и
                                двойная кнопка. Либо можно проложить проводку из комплекта дополнительно.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="question">
                            <p><span class="name">Василий</span> <span class="date">23.03.17</span></p>
                            <p class="quest-txt">Кнопка двойная или одинарная и включает сразу передние ПТФ и задние ПТФ?</p>
                        </div>
                        <div class="answer">
                            <p class="title">Ответ от <span>Caroptics.ru</span>:</p>
                            <p>Одинарная, она такая как у вас, т.е. включает задние. Чтобы включались передние нужна чать проводки по бамперу, реле и
                                двойная кнопка. Либо можно проложить проводку из комплекта дополнительно.</p>
                        </div>
                    </div>
                </div>
                <div class="tab-info">
                    <p>Здесь можно задать вопрос по данному товару, например, о комплектности, совместимости, особенностях или других нюансах.
                        Вопросы о доставке, сроках поступления правильно задавать <a href="#" class="green-href">здесь</a>.</p>
                    <p>ВНИМАНИЕ! Если вы хотите получить ответ на свой вопрос, укажите адрес электронной почты.</p>
                    <button class="btn">Задать вопрос</button>
                </div>
            </div>
        </div>
    </div>
    <div class="payment-info-mobile"></div>
    <div class="product-menus-mobile"></div>
</div>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:35
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/product.cart.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0eb0f6a3181_82312919')) {function content_59b0eb0f6a3181_82312919($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_date')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_date.php';
?><div class="cart-block">
    <form id="cart-form<?php if ($_smarty_tpl->tpl_vars['wa']->value->get('cart')){?>-dialog<?php }?>" method="post" action="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('/frontendCart/add');?>
">
        <div class="cart-block-top">
            <?php if ($_smarty_tpl->tpl_vars['product']->value['compare_price']){?>
                <p class="old-price"><?php echo shop_currency_html($_smarty_tpl->tpl_vars['product']->value['compare_price']);?>
</p>
            <?php }?>
            
            <div class="reviews-short">
                <a href="#" class="open_review" data-scroll=".reactions"><?php echo $_smarty_tpl->tpl_vars['reviews_total_count']->value;?>
 отзывов</a>
                <div class="rating">
                    <?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int)ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0){
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++){
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
                        <?php if ($_smarty_tpl->tpl_vars['foo']->value<=$_smarty_tpl->tpl_vars['product']->value['rating']){?>
                            <span></span>
                        <?php }elseif($_smarty_tpl->tpl_vars['foo']->value>$_smarty_tpl->tpl_vars['product']->value['rating']&&$_smarty_tpl->tpl_vars['foo']->value+1<$_smarty_tpl->tpl_vars['product']->value['rating']){?>
                            <span class="floor"></span>
                        <?php }else{ ?>
                            <span class="empty"></span>
                        <?php }?>
                    <?php }} ?>
                </div>
            </div>
            
        </div>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['sku_type']){?>

            <!-- SELECTABLE FEATURES selling mode -->
            <?php $_smarty_tpl->tpl_vars['default_sku_features'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['sku_features'], null, 0);?>
            <?php $_smarty_tpl->tpl_vars['product_available'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['status'], null, 0);?>

            <?php if ($_smarty_tpl->tpl_vars['theme_settings']->value['selectable_features_control']=='inline'){?>
                <div class="options">
                    <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features_selectable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                        <div class="inline-select<?php if ($_smarty_tpl->tpl_vars['f']->value['type']=='color'){?> color<?php }?>">
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['v_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['v_id']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <?php if (!isset($_smarty_tpl->tpl_vars['default_sku_features']->value[$_smarty_tpl->tpl_vars['f']->value['id']])){?><?php $_smarty_tpl->createLocalArrayVariable('default_sku_features', null, 0);
$_smarty_tpl->tpl_vars['default_sku_features']->value[$_smarty_tpl->tpl_vars['f']->value['id']] = $_smarty_tpl->tpl_vars['v_id']->value;?><?php }?>
                                <a data-value="<?php echo $_smarty_tpl->tpl_vars['v_id']->value;?>
" href="#"<?php if ($_smarty_tpl->tpl_vars['v_id']->value==ifset($_smarty_tpl->tpl_vars['default_sku_features']->value[$_smarty_tpl->tpl_vars['f']->value['id']])){?> class="selected"<?php }?><?php if ($_smarty_tpl->tpl_vars['f']->value['type']=='color'){?> style="<?php echo $_smarty_tpl->tpl_vars['v']->value->style;?>
; margin-bottom: 20px;"<?php }?>>
                                    <?php if ($_smarty_tpl->tpl_vars['f']->value['type']=='color'){?>&nbsp;<i class="icon16 checkmark color_checkmark"></i><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['f']->value['type']=='color'){?>&nbsp;<span class="color_name"><?php echo strip_tags($_smarty_tpl->tpl_vars['v']->value);?>
</span><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
<?php }?>
                                </a>
                            <?php } ?>
                            <input type="hidden" data-feature-id="<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
" class="sku-feature" name="features[<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
]" value="<?php echo ifset($_smarty_tpl->tpl_vars['default_sku_features']->value[$_smarty_tpl->tpl_vars['f']->value['id']]);?>
">
                        </div>
                    <?php } ?>
                </div>
            <?php }else{ ?>
                <div class="options">
                    <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features_selectable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
                        <?php echo $_smarty_tpl->tpl_vars['f']->value['name'];?>
:
                        <select data-feature-id="<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
" class="sku-feature" name="features[<?php echo $_smarty_tpl->tpl_vars['f']->value['id'];?>
]">
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['v_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['f']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['v_id']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['v_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['v_id']->value==ifset($_smarty_tpl->tpl_vars['default_sku_features']->value[$_smarty_tpl->tpl_vars['f']->value['id']])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
                            <?php } ?>
                        </select>
                        <br>
                    <?php } ?>
                </div>
            <?php }?>

            <!-- list all SKUs for Schema.org markup -->
            <?php  $_smarty_tpl->tpl_vars['sku'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sku']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['skus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sku']->key => $_smarty_tpl->tpl_vars['sku']->value){
$_smarty_tpl->tpl_vars['sku']->_loop = true;
?>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <?php $_smarty_tpl->tpl_vars['sku_available'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['status']&&$_smarty_tpl->tpl_vars['sku']->value['available']&&($_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')||$_smarty_tpl->tpl_vars['sku']->value['count']===null||$_smarty_tpl->tpl_vars['sku']->value['count']>0), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['sku']->value['name']){?>
                        <meta itemprop="name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sku']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
                    <meta itemprop="price" content="<?php echo $_smarty_tpl->tpl_vars['sku']->value['price'];?>
">
                    <meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['product']->value['currency'];?>
">
                    <?php if ((!($_smarty_tpl->tpl_vars['sku']->value['count']===null)&&$_smarty_tpl->tpl_vars['sku']->value['count']<=0)){?>
                        <link itemprop="availability" href="http://schema.org/OutOfStock" />
                    <?php }else{ ?>
                        <link itemprop="availability" href="http://schema.org/InStock" />
                    <?php }?>
                </div>
            <?php } ?>

        <?php }else{ ?>

            <!-- FLAT SKU LIST selling mode -->
            <?php $_smarty_tpl->tpl_vars['product_available'] = new Smarty_variable(false, null, 0);?>
            <?php if (count($_smarty_tpl->tpl_vars['product']->value['skus'])>1){?>

                
                <ul class="skus">
                    <?php  $_smarty_tpl->tpl_vars['sku'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sku']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['skus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sku']->key => $_smarty_tpl->tpl_vars['sku']->value){
$_smarty_tpl->tpl_vars['sku']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['sku_available'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['status']&&$_smarty_tpl->tpl_vars['sku']->value['available']&&($_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')||$_smarty_tpl->tpl_vars['sku']->value['count']===null||$_smarty_tpl->tpl_vars['sku']->value['count']>0), null, 0);?>
                        <li itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <label<?php if (!$_smarty_tpl->tpl_vars['sku']->value['available']){?> class="disabled"<?php }?>>
                                <input name="sku_id" type="radio" value="<?php echo $_smarty_tpl->tpl_vars['sku']->value['id'];?>
"<?php if (!$_smarty_tpl->tpl_vars['sku']->value['available']){?> disabled="true" <?php }?><?php if (!$_smarty_tpl->tpl_vars['sku_available']->value){?>data-disabled="1"<?php }?><?php if ($_smarty_tpl->tpl_vars['sku']->value['id']==$_smarty_tpl->tpl_vars['product']->value['sku_id']){?> checked="checked"<?php }?> data-compare-price="<?php echo shop_currency($_smarty_tpl->tpl_vars['sku']->value['compare_price'],$_smarty_tpl->tpl_vars['product']->value['currency'],null,0);?>
" data-price="<?php echo shop_currency($_smarty_tpl->tpl_vars['sku']->value['price'],$_smarty_tpl->tpl_vars['product']->value['currency'],null,0);?>
"<?php if ($_smarty_tpl->tpl_vars['sku']->value['image_id']){?> data-image-id="<?php echo $_smarty_tpl->tpl_vars['sku']->value['image_id'];?>
"<?php }?>> <span itemprop="name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sku']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['sku']->value['sku']){?><span class="hint"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sku']->value['sku'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>
                                <meta itemprop="price" content="<?php echo $_smarty_tpl->tpl_vars['sku']->value['price'];?>
">
                                <meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['product']->value['currency'];?>
">
                                <span class="price tiny nowrap"><?php echo shop_currency_html($_smarty_tpl->tpl_vars['sku']->value['price'],$_smarty_tpl->tpl_vars['product']->value['currency']);?>
</span>
                                <?php if ((!($_smarty_tpl->tpl_vars['sku']->value['count']===null)&&$_smarty_tpl->tpl_vars['sku']->value['count']<=0)){?>
                                    <link itemprop="availability" href="http://schema.org/OutOfStock" />
                                <?php }else{ ?>
                                    <link itemprop="availability" href="http://schema.org/InStock" />
                                <?php }?>
                            </label>
                        </li>
                        <?php $_smarty_tpl->tpl_vars['product_available'] = new Smarty_variable($_smarty_tpl->tpl_vars['product_available']->value||$_smarty_tpl->tpl_vars['sku_available']->value, null, 0);?>
                    <?php } ?>
                </ul>
            <?php }else{ ?>

                
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <?php $_smarty_tpl->tpl_vars['sku'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['skus'][$_smarty_tpl->tpl_vars['product']->value['sku_id']], null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['sku']->value['name']){?>
                        <meta itemprop="name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sku']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
                    <meta itemprop="price" content="<?php echo $_smarty_tpl->tpl_vars['sku']->value['price'];?>
">
                    <meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['product']->value['currency'];?>
">
                    <?php if (!$_smarty_tpl->tpl_vars['sku']->value['available']){?>
                        <link itemprop="availability" href="http://schema.org/Discontinued" />
                        <p><em class="bold error">Этот товар временно недоступен для заказа</em></p>
                    <?php }elseif(!$_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')&&!($_smarty_tpl->tpl_vars['sku']->value['count']===null||$_smarty_tpl->tpl_vars['sku']->value['count']>0)){?>
                        <link itemprop="availability" href="http://schema.org/OutOfStock" />
                        <div class="stocks"><strong class="stock-none"><i class="icon16 stock-transparent"></i><?php if ($_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')){?>Под заказ<?php }else{ ?>Нет в наличии<?php }?></strong></div>
                    <?php }else{ ?>
                        <link itemprop="availability" href="http://schema.org/InStock" />
                    <?php }?>
                    <input name="sku_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['sku_id'];?>
">
                    <?php $_smarty_tpl->tpl_vars['product_available'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['status']&&$_smarty_tpl->tpl_vars['sku']->value['available']&&($_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')||$_smarty_tpl->tpl_vars['sku']->value['count']===null||$_smarty_tpl->tpl_vars['sku']->value['count']>0), null, 0);?>
                </div>
            <?php }?>

        <?php }?>
        <div class="purchase">
            <?php if ($_smarty_tpl->tpl_vars['services']->value){?>
                <!-- services -->
                <div class="services">
                    <?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['services']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
$_smarty_tpl->tpl_vars['s']->_loop = true;
?>
                        <div class="service-<?php echo $_smarty_tpl->tpl_vars['s']->value['id'];?>
">
                            <label>
                                <input data-price="<?php echo shop_currency($_smarty_tpl->tpl_vars['s']->value['price'],$_smarty_tpl->tpl_vars['s']->value['currency'],null,0);?>
" <?php if (!$_smarty_tpl->tpl_vars['product_available']->value){?>disabled="disabled"<?php }?> type="checkbox" name="services[]" value="<?php echo $_smarty_tpl->tpl_vars['s']->value['id'];?>
"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php if ($_smarty_tpl->tpl_vars['s']->value['price']&&!isset($_smarty_tpl->tpl_vars['s']->value['variants'])){?>(+<span class="service-price"><?php echo shop_currency_html($_smarty_tpl->tpl_vars['s']->value['price'],$_smarty_tpl->tpl_vars['s']->value['currency']);?>
</span>)<?php }?>
                            </label>
                            <?php if (isset($_smarty_tpl->tpl_vars['s']->value['variants'])){?>
                                <select data-variant-id="<?php echo $_smarty_tpl->tpl_vars['s']->value['variant_id'];?>
" class="service-variants" name="service_variant[<?php echo $_smarty_tpl->tpl_vars['s']->value['id'];?>
]" disabled>
                                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['s']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                                        <option <?php if ($_smarty_tpl->tpl_vars['s']->value['variant_id']==$_smarty_tpl->tpl_vars['v']->value['id']){?>selected<?php }?> data-price="<?php echo shop_currency($_smarty_tpl->tpl_vars['v']->value['price'],$_smarty_tpl->tpl_vars['s']->value['currency'],null,0);?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['v']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 (+<?php echo shop_currency($_smarty_tpl->tpl_vars['v']->value['price'],$_smarty_tpl->tpl_vars['s']->value['currency']);?>
)</option>
                                    <?php } ?>
                                </select>
                            <?php }else{ ?>
                                <input type="hidden" name="service_variant[<?php echo $_smarty_tpl->tpl_vars['s']->value['id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['s']->value['variant_id'];?>
">
                            <?php }?>
                        </div>
                    <?php } ?>
                </div>
            <?php }?>
            <p class="current"><?php echo shop_currency_html($_smarty_tpl->tpl_vars['product']->value['price']);?>
</p>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['edit_datetime']){?>
                <p class="upd"><b>Обновлено:</b> <?php echo smarty_modifier_wa_date($_smarty_tpl->tpl_vars['product']->value['edit_datetime'],'humandatetime');?>
</p>
            <?php }?>
            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
">
            <button class="btn green-btn" type="submit" <?php if (!$_smarty_tpl->tpl_vars['product_available']->value){?>disabled="disabled"<?php }?>>В корзину</button>
            <?php if (ceil($_smarty_tpl->tpl_vars['product']->value['total_sales']/$_smarty_tpl->tpl_vars['product']->value['price'])>2){?>
                <p class="selled">Товар заказали: <span><?php echo ceil($_smarty_tpl->tpl_vars['product']->value['total_sales']/$_smarty_tpl->tpl_vars['product']->value['price']);?>
 раз</span></p>
            <?php }?>

            <?php $_smarty_tpl->tpl_vars['sku'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['skus'][$_smarty_tpl->tpl_vars['product']->value['sku_id']], null, 0);?>
            <?php if (!$_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')&&($_smarty_tpl->tpl_vars['sku']->value['count']===null||$_smarty_tpl->tpl_vars['sku']->value['count']>0)&&$_smarty_tpl->tpl_vars['sku']->value['available']){?>
                <div class="in_stock">В наличии</div>
            <?php }?>
            <p class="delivery"><a href="#" class="green-href border_bottom_dashed" onclick="$('#city_select_link').click();return false;">Выбрать другой город</a> <span>в <span class="cityName"></span></span></p>
            <p class="delivery-place">ТК СДЭК – 385<i class="fa fa-rub" aria-hidden="true"></i></p>
            <span class="delivery-variants" data-scroll=".delivers">Все способы доставки <span>в <span class="cityName"></span></span></span>
        </div>
    </form>
</div>
<script>
    (function ($) {
        $.getScript("<?php echo $_smarty_tpl->tpl_vars['wa_theme_url']->value;?>
product.js?v<?php echo $_smarty_tpl->tpl_vars['wa_theme_version']->value;?>
", function () {
            if (typeof Product === "function") {
                new Product('#cart-form<?php if ($_smarty_tpl->tpl_vars['wa']->value->get('cart')){?>-dialog<?php }?>', {
                    currency: <?php echo json_encode($_smarty_tpl->tpl_vars['currency_info']->value);?>

                    <?php if (count($_smarty_tpl->tpl_vars['product']->value['skus'])>1||$_smarty_tpl->tpl_vars['product']->value['sku_type']){?>
                    , services: <?php echo json_encode($_smarty_tpl->tpl_vars['sku_services']->value);?>

                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['sku_type']){?>
                    , features: <?php echo json_encode($_smarty_tpl->tpl_vars['sku_features_selectable']->value);?>

                    <?php }?>
                });
            }
        });
    })(jQuery);
</script><?php }} ?>