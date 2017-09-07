<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:45:35
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/edost/templates/FrontendProduct.html" */ ?>
<?php /*%%SmartyHeaderCode:113812413759b0eb0f4b9ec8-57020844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eda6108892bb04b10923a06a1bb997a90bfb12d6' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/edost/templates/FrontendProduct.html',
      1 => 1504592547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113812413759b0eb0f4b9ec8-57020844',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb0f52bf85_40903991',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb0f52bf85_40903991')) {function content_59b0eb0f52bf85_40903991($_smarty_tpl) {?><div class="edost-plugin"></div>
<script type="text/javascript">
    $(function () {
        var loading = $('<span><i class="icon16 loading"></i> Загрузка...</span>');
        $('.edost-plugin').html(loading);

        function load() {
            $.ajax({
                url: '<?php echo $_smarty_tpl->tpl_vars['wa']->value->getUrl('shop/frontend/edost');?>
',
                type: 'get',
                data:{
                    sku_id: $('input[name=sku_id]').val()
                },
                success: function (response) {
                    $('.edost-plugin').html(response);
                }
            });
        }
        load();

        var city = $('#city_select_link').html();
        setInterval(function () {
            if (city != $('#city_select_link').html()) {
                city = $('#city_select_link').html();
                load();
            }
        }, 500);
    });
</script><?php }} ?>