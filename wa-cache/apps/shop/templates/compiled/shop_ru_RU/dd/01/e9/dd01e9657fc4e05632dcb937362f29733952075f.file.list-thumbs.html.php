<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:20
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/list-thumbs.html" */ ?>
<?php /*%%SmartyHeaderCode:49429951259b0eb00710386-74503296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd01e9657fc4e05632dcb937362f29733952075f' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/themes/caroptics/list-thumbs.html',
      1 => 1500884725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49429951259b0eb00710386-74503296',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sorting' => 0,
    'active_sort' => 0,
    'wa' => 0,
    'category' => 0,
    'sort_fields' => 0,
    'sort' => 0,
    'name' => 0,
    'products' => 0,
    'product_ids' => 0,
    'p' => 0,
    'products_skus' => 0,
    'skus' => 0,
    'badge_html' => 0,
    'wa_theme_url' => 0,
    'sku' => 0,
    'p_category' => 0,
    'product_item' => 0,
    'available' => 0,
    'pages_count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb008f0bc0_48273972',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb008f0bc0_48273972')) {function content_59b0eb008f0bc0_48273972($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
if (!is_callable('smarty_function_wa_pagination')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/function.wa_pagination.php';
?><div id="product-list" class="anim_all_05">
    <!-- products thumbnail list view -->
    <?php if (!empty($_smarty_tpl->tpl_vars['sorting']->value)){?>
        <!-- sorting -->
        <?php $_smarty_tpl->tpl_vars['sort_fields'] = new Smarty_variable(array('price'=>'по цене','total_sales'=>'по популярности'), null, 0);?>
        <?php if (!isset($_smarty_tpl->tpl_vars['active_sort']->value)){?>
            <?php $_smarty_tpl->tpl_vars['active_sort'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->get('sort',''), null, 0);?>
        <?php }?>
        <div class="mod-filters desc">
            <p>Сортировка:</p>
            <?php if (!empty($_smarty_tpl->tpl_vars['category']->value)&&!$_smarty_tpl->tpl_vars['category']->value['sort_products']){?>
                <div class="rad<?php if (!$_smarty_tpl->tpl_vars['active_sort']->value){?> selected<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->currentUrl(0,1);?>
">по умолчанию</a></div>
            <?php }?>
            <?php  $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['name']->_loop = false;
 $_smarty_tpl->tpl_vars['sort'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sort_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['name']->key => $_smarty_tpl->tpl_vars['name']->value){
$_smarty_tpl->tpl_vars['name']->_loop = true;
 $_smarty_tpl->tpl_vars['sort']->value = $_smarty_tpl->tpl_vars['name']->key;
?>
                <div class="rad<?php if ($_smarty_tpl->tpl_vars['active_sort']->value==$_smarty_tpl->tpl_vars['sort']->value){?> selected<?php }?>"><?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->sortUrl($_smarty_tpl->tpl_vars['sort']->value,$_smarty_tpl->tpl_vars['name']->value,$_smarty_tpl->tpl_vars['active_sort']->value,$_smarty_tpl->tpl_vars['active_sort']->value);?>
</div>
            <?php if ($_smarty_tpl->tpl_vars['wa']->value->get('sort')==$_smarty_tpl->tpl_vars['sort']->value){?><?php echo $_smarty_tpl->tpl_vars['wa']->value->title((($_smarty_tpl->tpl_vars['wa']->value->title()).(' — ')).($_smarty_tpl->tpl_vars['name']->value));?>
<?php }?>
        <?php } ?>
    </div>
    <div class="mod-filters mobile">
        <p>Сортировка:</p>
        <select name="filters" id="filters">
            <option value="1">По умолчанию</option>
            <option value="2">По цене</option>
            <option value="3">По популярности</option>
        </select>
    </div>
<?php }?>
<div class="pop-products-wrapper product-list">

    <?php $_smarty_tpl->tpl_vars['product_ids'] = new Smarty_variable(array_keys($_smarty_tpl->tpl_vars['products']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['products_skus'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->skus($_smarty_tpl->tpl_vars['product_ids']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['features'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->features($_smarty_tpl->tpl_vars['products']->value), null, 0);?>

    <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars['skus'] = new Smarty_variable($_smarty_tpl->tpl_vars['products_skus']->value[$_smarty_tpl->tpl_vars['p']->value['id']], null, 0);?>
        <?php $_smarty_tpl->tpl_vars['sku'] = new Smarty_variable($_smarty_tpl->tpl_vars['skus']->value[0], null, 0);?>
        <?php $_smarty_tpl->tpl_vars['available'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->settings('ignore_stock_count')||$_smarty_tpl->tpl_vars['p']->value['count']===null||$_smarty_tpl->tpl_vars['p']->value['count']>0, null, 0);?>
        <div class="block-item" itemscope itemtype="http://schema.org/Product">
            <div class="block">
                <div class="img">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['p']->value['frontend_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
<?php if ($_smarty_tpl->tpl_vars['p']->value['summary']){?> &mdash; <?php echo strip_tags($_smarty_tpl->tpl_vars['p']->value['summary']);?>
<?php }?>">
                        <?php $_smarty_tpl->tpl_vars['badge_html'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->badgeHtml($_smarty_tpl->tpl_vars['p']->value['badge']), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['badge_html']->value){?>
                            <div class="corner top right"><?php echo $_smarty_tpl->tpl_vars['badge_html']->value;?>
</div>
                        <?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->productImgHtml($_smarty_tpl->tpl_vars['p']->value,'136x0',array('itemprop'=>'image','alt'=>$_smarty_tpl->tpl_vars['p']->value['name'],'default'=>((string)$_smarty_tpl->tpl_vars['wa_theme_url']->value)."img/dummy200.png"));?>

                        <?php if ($_smarty_tpl->tpl_vars['p']->value['rating']>0){?>
                            <span class="rating nowrap"><?php echo $_smarty_tpl->tpl_vars['wa']->value->shop->ratingHtml($_smarty_tpl->tpl_vars['p']->value['rating']);?>
</span>
                        <?php }?>
                    </a>
                </div>
                <div class="title">
                    <p><?php echo $_smarty_tpl->tpl_vars['sku']->value['sku'];?>
</p>
                </div>

                <?php $_smarty_tpl->tpl_vars['p_category'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->category($_smarty_tpl->tpl_vars['p']->value['category_id']), null, 0);?>
                <?php $_smarty_tpl->tpl_vars['p_category_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->categoryUrl($_smarty_tpl->tpl_vars['p_category']->value), null, 0);?>
                <div class="info">
                    <p class="mobile serial"><?php echo $_smarty_tpl->tpl_vars['sku']->value['sku'];?>
</p>
                    <p class="type"><a href="<?php echo $_smarty_tpl->tpl_vars['p']->value['frontend_url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
</a></p>
                    <p class="descr" itemprop="description"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['p']->value['summary'],255);?>
 с корректором, с линзой, с диодной полосой, внутри черные.</p>
                    <p class="mobile manufacturer"><span>Производитель: </span>EAGLE EYES</p>
                    <p class="mobile date"><span>Период выпуска: </span> <?php echo $_smarty_tpl->tpl_vars['product_item']->value['features']['period_vypuska'];?>
</p>
                </div>
                <div class="years"><p><?php echo $_smarty_tpl->tpl_vars['p']->value['features']['period_vypuska'];?>
</p></div>
                <div itemprop="offers" class="offers controls" itemscope itemtype="http://schema.org/Offer">
                    <?php if ($_smarty_tpl->tpl_vars['available']->value){?>
                        <?php if ($_smarty_tpl->tpl_vars['p']->value['compare_price']>0){?><p class="compare-at-price nowrap"> <?php echo shop_currency_html($_smarty_tpl->tpl_vars['p']->value['compare_price']);?>
 </p><?php }?>
                        <p class="price nowrap" itemprop="price"><?php echo shop_currency_html($_smarty_tpl->tpl_vars['p']->value['price']);?>
</p>
                        <form class="addtocart" <?php if ($_smarty_tpl->tpl_vars['p']->value['sku_count']>1){?>data-url="<?php echo $_smarty_tpl->tpl_vars['p']->value['frontend_url'];?>
<?php if (strpos($_smarty_tpl->tpl_vars['p']->value['frontend_url'],'?')){?>&<?php }else{ ?>?<?php }?>cart=1"<?php }?> method="post" action="<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('/frontendCart/add');?>
">
                            <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
">
                            <button class="btn green-btn" type="submit">В корзину</button>
                            <div class="delivery">
                                <p>В наличии</p>
                            </div>
                        </form>
                        <link itemprop="availability" href="http://schema.org/InStock" />
                    <?php }else{ ?>
                        <button class="btn" disabled type="submit">В корзину</button>
                        <div class="delivery">
                            <p style="color:red">Нет на складе</p>
                        </div>
                        <link itemprop="availability" href="http://schema.org/OutOfStock" />
                    <?php }?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php if (isset($_smarty_tpl->tpl_vars['pages_count']->value)&&$_smarty_tpl->tpl_vars['pages_count']->value>1){?>
    <div class="block pagination lazyloading-paging" data-loading-str="Загрузка...">
        <?php echo smarty_function_wa_pagination(array('total'=>$_smarty_tpl->tpl_vars['pages_count']->value,'attrs'=>array('class'=>"menu-h")),$_smarty_tpl);?>

    </div>
<?php }?>
</div><?php }} ?>