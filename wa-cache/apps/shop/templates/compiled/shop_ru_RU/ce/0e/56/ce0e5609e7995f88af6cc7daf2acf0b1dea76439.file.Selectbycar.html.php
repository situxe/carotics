<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:49
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/selectbycar/templates/Selectbycar.html" */ ?>
<?php /*%%SmartyHeaderCode:53375857559b0e901e5a470-95266214%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce0e5609e7995f88af6cc7daf2acf0b1dea76439' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/selectbycar/templates/Selectbycar.html',
      1 => 1499765369,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53375857559b0e901e5a470-95266214',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'wa' => 0,
    'category' => 0,
    'parent_category' => 0,
    'parent_category2' => 0,
    'category_id' => 0,
    'first_categories' => 0,
    'first_category' => 0,
    'breadcrumbs' => 0,
    'second_category' => 0,
    'third_category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e902017ce2_63984281',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e902017ce2_63984281')) {function content_59b0e902017ce2_63984281($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['breadcrumbs'] = new Smarty_variable(array(), null, 0);?>
<?php if (!empty($_smarty_tpl->tpl_vars['product']->value)){?>
     <?php $_smarty_tpl->tpl_vars['category'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->category($_smarty_tpl->tpl_vars['product']->value['category_id']), null, 0);?>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['category']->value)){?>
    <?php if ($_smarty_tpl->tpl_vars['category']->value['parent_id']){?>
        <?php $_smarty_tpl->tpl_vars['parent_category'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->category($_smarty_tpl->tpl_vars['category']->value['parent_id']), null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['parent_category']->value['parent_id']){?>
            <?php $_smarty_tpl->tpl_vars['parent_category2'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->category($_smarty_tpl->tpl_vars['parent_category']->value['parent_id']), null, 0);?>
            <?php $_smarty_tpl->createLocalArrayVariable('breadcrumbs', null, 0);
$_smarty_tpl->tpl_vars['breadcrumbs']->value[] = $_smarty_tpl->tpl_vars['parent_category2']->value['id'];?>
        <?php }?>
        <?php $_smarty_tpl->createLocalArrayVariable('breadcrumbs', null, 0);
$_smarty_tpl->tpl_vars['breadcrumbs']->value[] = $_smarty_tpl->tpl_vars['parent_category']->value['id'];?>
    <?php }?>
    <?php $_smarty_tpl->createLocalArrayVariable('breadcrumbs', null, 0);
$_smarty_tpl->tpl_vars['breadcrumbs']->value[] = $_smarty_tpl->tpl_vars['category']->value['id'];?>
<?php }?>
<?php $_smarty_tpl->tpl_vars['first_categories'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->shop->categories($_smarty_tpl->tpl_vars['category_id']->value,null,true), null, 0);?>

    <div class="select-form">
        <p>Выберите Ваш автомобиль:</p>
        <select id="first-category" data-placeholder="Выберите марку...">
            <option value="">Выберите марку...</option>
            <?php  $_smarty_tpl->tpl_vars['first_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['first_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['first_categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['first_category']->key => $_smarty_tpl->tpl_vars['first_category']->value){
$_smarty_tpl->tpl_vars['first_category']->_loop = true;
?>
                <option data-id="<?php echo $_smarty_tpl->tpl_vars['first_category']->value['id'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_category']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if (in_array($_smarty_tpl->tpl_vars['first_category']->value['id'],$_smarty_tpl->tpl_vars['breadcrumbs']->value)){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['first_category']->value['name'];?>
</option>
            <?php } ?>
        </select>
        <select id="second-category" data-placeholder="Выберите модель...">
            <option value="">Выберите модель...</option>
            <?php  $_smarty_tpl->tpl_vars['first_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['first_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['first_categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['first_category']->key => $_smarty_tpl->tpl_vars['first_category']->value){
$_smarty_tpl->tpl_vars['first_category']->_loop = true;
?>
                <?php if (!empty($_smarty_tpl->tpl_vars['first_category']->value['childs'])){?>
                    <?php  $_smarty_tpl->tpl_vars['second_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['second_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['first_category']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['second_category']->key => $_smarty_tpl->tpl_vars['second_category']->value){
$_smarty_tpl->tpl_vars['second_category']->_loop = true;
?>
                        <option class="hidden" data-parent-id="<?php echo $_smarty_tpl->tpl_vars['first_category']->value['id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['second_category']->value['id'];?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_category']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if (in_array($_smarty_tpl->tpl_vars['second_category']->value['id'],$_smarty_tpl->tpl_vars['breadcrumbs']->value)){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['second_category']->value['name'];?>
</option>
                    <?php } ?>
                <?php }?>
            <?php } ?>
        </select>
        
        <select id="third-category" data-placeholder="Выберите год...">
            <option value="">Выберите год...</option>
            <?php  $_smarty_tpl->tpl_vars['first_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['first_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['first_categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['first_category']->key => $_smarty_tpl->tpl_vars['first_category']->value){
$_smarty_tpl->tpl_vars['first_category']->_loop = true;
?>
                <?php if (!empty($_smarty_tpl->tpl_vars['first_category']->value['childs'])){?>
                    <?php  $_smarty_tpl->tpl_vars['second_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['second_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['first_category']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['second_category']->key => $_smarty_tpl->tpl_vars['second_category']->value){
$_smarty_tpl->tpl_vars['second_category']->_loop = true;
?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['second_category']->value['childs'])){?>
                            <?php  $_smarty_tpl->tpl_vars['third_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['third_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['second_category']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['third_category']->key => $_smarty_tpl->tpl_vars['third_category']->value){
$_smarty_tpl->tpl_vars['third_category']->_loop = true;
?>
                                <option class="hidden" data-parent-id="<?php echo $_smarty_tpl->tpl_vars['second_category']->value['id'];?>
"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['third_category']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if (in_array($_smarty_tpl->tpl_vars['third_category']->value['id'],$_smarty_tpl->tpl_vars['breadcrumbs']->value)){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['third_category']->value['name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    <?php } ?>
                <?php }?>
            <?php } ?>
        </select>
        <a href="#" class="btn" id="select_from_submit">Перейти</a>
    </div>

<script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            $('#select_from_submit').click(function(){
                if($('#third-category').val()) {
                    window.location.href = $('#third-category').val();
                } else if($('#second-category').val()) {
                    window.location.href = $('#second-category').val();
                } else if($('#first-category').val()) {
                    window.location.href = $('#first-category').val();
                }
                return false; 
            });
            $('#first-category,#second-category,#third-category').change(function () {
                if ($(this).attr('id') == 'first-category') {
                    $('#second-category option[value!=""]').addClass('hidden');
                    $('#second-category').val('');
                    $('#third-category option[value!=""]').addClass('hidden');
                    $('#third-category').val('');
                    if ($(this).val()) {
                        $('#second-category option[data-parent-id=' + $(this).find('option:selected').data('id') + ']').removeClass('hidden');
                    }
                } else if ($(this).attr('id') == 'second-category') {
                    $('#third-category option[value!=""]').addClass('hidden');
                    $('#third-category').val('');
                    if ($(this).val()) {
                        $('#third-category option[data-parent-id=' + $(this).find('option:selected').data('id') + ']').removeClass('hidden');
                    }
                } else if ($(this).attr('id') == 'third-category' && $(this).val()) {
                    window.location.href = $(this).val();
                }
                $('#first-category,#second-category,#third-category').trigger('refresh');
            });

            if ($('#first-category option:selected').length) {
                $('#second-category option[data-parent-id=' + $('#first-category option:selected').data('id') + ']').removeClass('hidden');
            }
            if ($('#second-category option:selected').length) {
                $('#third-category option[data-parent-id=' + $('#second-category option:selected').data('id') + ']').removeClass('hidden');
            }
            $('#first-category,#second-category,#third-category').trigger('refresh');
        });
    });
</script>
<?php }} ?>