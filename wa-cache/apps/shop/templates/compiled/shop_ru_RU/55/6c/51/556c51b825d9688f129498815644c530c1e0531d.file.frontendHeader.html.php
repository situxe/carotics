<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:50
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/recall/templates/frontendHeader.html" */ ?>
<?php /*%%SmartyHeaderCode:69943764659b0e9025e0111-15888066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '556c51b825d9688f129498815644c530c1e0531d' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/shop/plugins/recall/templates/frontendHeader.html',
      1 => 1499076080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69943764659b0e9025e0111-15888066',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rc_theme_id' => 0,
    'wa_url' => 0,
    'rc_theme_path' => 0,
    'rc_theme_settings' => 0,
    'rc_route_url' => 0,
    'rc_sys_settings' => 0,
    'rc_user_id' => 0,
    'rc_user_name' => 0,
    'rc_user_phone' => 0,
    'rc_user_email' => 0,
    'rc_fields' => 0,
    'rc_field' => 0,
    'rc_value' => 0,
    'wa' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e902703d93_58732138',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e902703d93_58732138')) {function content_59b0e902703d93_58732138($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['rc_theme_id']->value!='off'){?>
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['rc_theme_path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['rc_theme_id']->value;?>
/theme.css?nocache=1" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/recall/css/frontend.css?nocache=1" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-apps/shop/plugins/recall/js/bpopup.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#recall_plugin .recall_ref_url").val(window.location.href);
            $("#recall_plugin .recall_product").val("-1");

            $(".<?php echo $_smarty_tpl->tpl_vars['rc_theme_settings']->value['hook'];?>
").click(function () {
                $("#recall_plugin .recall_product").val("-1");
                $("#recall_plugin .recall_error").hide();
                $("#recall_plugin .recall_form").show();
                $("#recall_plugin .recall_success_container").hide();
                $("#recall_plugin .recall_textarea").val("");
                $("#recall_plugin .wa-captcha-input").val("");
                $("#recall_plugin .wa-captcha-refresh").trigger("click");
                $("#recall_plugin").bPopup();
            });

            $(".recall_ask_about_the_product").click(function () {
                $("#recall_plugin .recall_product").val($(this).attr('data-pid'));
                $("#recall_plugin .recall_error").hide();
                $("#recall_plugin .recall_form").show();
                $("#recall_plugin .recall_success_container").hide();
                $("#recall_plugin .recall_textarea").val("Вопрос о товаре: ");
                $("#recall_plugin .wa-captcha-input").val("");
                $("#recall_plugin .wa-captcha-refresh").trigger("click");
                $("#recall_plugin").bPopup();
            });

            $("#recall_plugin .recall_form").submit(function (event) {
                $.post('<?php echo $_smarty_tpl->tpl_vars['rc_route_url']->value;?>
', $(this).serialize(), function (JData) {
                    if (JData.data.result == 'error')
                    {
                        $("#recall_plugin .recall_error").html(JData.data.error);
                        $("#recall_plugin .recall_error").slideDown();
                    }
                    else
                    {
                        $("#recall_plugin .recall_success").html(JData.data.message);
                        $("#recall_plugin .recall_form").slideUp();
                        $("#recall_plugin .recall_success_container").slideDown();
                    }
                }, "json");
                return false;
            });
        });
    </script>
    <?php if ($_smarty_tpl->tpl_vars['rc_theme_settings']->value['itype']=='label'){?><div class="recall_deploy_window"></div><?php }?>
    <div class="recall_container" id="recall_plugin">
        <div class="recall_hat"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dheader'];?>
<div class="recall_close b-close"></div></div>
        <div class="recall_body">
            <div class="recall_header"></div>
            <div class="recall_disclaimer"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dwindow'];?>
</div>
            <div class="recall_success_container">
                <div class="recall_success"></div>
                <input type="button" class="b-close recall_submit" value="Закрыть"/>
            </div>
            <form class="recall_form">
                <input class="recall_ref_url" type="hidden" name="url" value="">
                <input class="recall_contact" type="hidden" name="contact" value="<?php echo $_smarty_tpl->tpl_vars['rc_user_id']->value;?>
">
                <input class="recall_product" type="hidden" name="product" value="">
                <div class="recall_field">
                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dname'];?>
</div>
                    <div class="recall_value"><input name="username" class="recall_input_text " type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['rc_user_name']->value)){?><?php echo $_smarty_tpl->tpl_vars['rc_user_name']->value;?>
<?php }?>"></div>
                </div>
                <div class="recall_field">
                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dphone'];?>
</div>
                    <div class="recall_value"><input name="phone" class="recall_input_text tel" type="tel"  value="<?php if (isset($_smarty_tpl->tpl_vars['rc_user_phone']->value)){?><?php echo $_smarty_tpl->tpl_vars['rc_user_phone']->value;?>
<?php }?>"></div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['rc_sys_settings']->value['askforemail']!='no'){?>
                    <div class="recall_field">
                        <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['demail'];?>
</div>
                        <div class="recall_value"><input name="email" class="recall_input_text email" type="email" value="<?php if (isset($_smarty_tpl->tpl_vars['rc_user_email']->value)){?><?php echo $_smarty_tpl->tpl_vars['rc_user_email']->value;?>
<?php }?>"></div>
                    </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['rc_fields']->value){?>
                    <?php  $_smarty_tpl->tpl_vars['rc_field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rc_field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rc_fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rc_field']->key => $_smarty_tpl->tpl_vars['rc_field']->value){
$_smarty_tpl->tpl_vars['rc_field']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['rc_field']->value['visible']){?>
                            <?php if ($_smarty_tpl->tpl_vars['rc_field']->value['type']=='text'){?>
                                <div class="recall_field recall_field_extra_text">
                                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_field']->value['name'];?>
</div>
                                    <div class="recall_value"><input name="fields[<?php echo $_smarty_tpl->tpl_vars['rc_field']->value['id'];?>
][value]" class="recall_input_text" type="text"></div>
                                </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['rc_field']->value['type']=='range'){?>
                                <div class="recall_field recall_field_extra_range">
                                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_field']->value['name'];?>
</div>
                                    <div class="recall_value">
                                        <input name="fields[<?php echo $_smarty_tpl->tpl_vars['rc_field']->value['id'];?>
][value][0]" class="recall_input_text" type="text">
                                        -
                                        <input name="fields[<?php echo $_smarty_tpl->tpl_vars['rc_field']->value['id'];?>
][value][1]" class="recall_input_text" type="text">
                                    </div>
                                </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['rc_field']->value['type']=='select'){?>
                                <div class="recall_field recall_field_extra_select">
                                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_field']->value['name'];?>
</div>
                                    <div class="recall_value">
                                        <select name="fields[<?php echo $_smarty_tpl->tpl_vars['rc_field']->value['id'];?>
][value]">
                                            <?php  $_smarty_tpl->tpl_vars['rc_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rc_value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rc_field']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rc_value']->key => $_smarty_tpl->tpl_vars['rc_value']->value){
$_smarty_tpl->tpl_vars['rc_value']->_loop = true;
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['rc_value']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rc_value']->value['name'];?>
</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['rc_field']->value['type']=='checkbox'){?>
                                <div class="recall_field recall_field_extra_checkbox">
                                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_field']->value['name'];?>
</div>
                                    <div class="recall_value">
                                        <?php  $_smarty_tpl->tpl_vars['rc_value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rc_value']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rc_field']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rc_value']->key => $_smarty_tpl->tpl_vars['rc_value']->value){
$_smarty_tpl->tpl_vars['rc_value']->_loop = true;
?>
                                            <div class="recall_value_checkbox">
                                                <input type="checkbox" name="fields[<?php echo $_smarty_tpl->tpl_vars['rc_field']->value['id'];?>
][value][<?php echo $_smarty_tpl->tpl_vars['rc_value']->value['id'];?>
]"><span class="recall_value_checkbox_val"><?php echo $_smarty_tpl->tpl_vars['rc_value']->value['name'];?>
</span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }?>
                        <?php }?>
                    <?php } ?>
                <?php }?>
                <div class="recall_field">
                    <div class="recall_name"><?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dcomment'];?>
</div>
                    <div class="recall_value recall_value_textarea"><textarea name="comment" class="recall_textarea"></textarea></div>
                </div>
            <?php if ($_smarty_tpl->tpl_vars['rc_sys_settings']->value['captcha']){?><?php echo $_smarty_tpl->tpl_vars['wa']->value->captcha();?>
<?php }?>
            <div class="recall_error"></div>
                <div class="recall_field">
                    <label class="zakon152"><input type="checkbox" checked="checked" required="required" name="zakon152">Настоящим в соответствии с Федеральным законом № 152-ФЗ «О персональных данных» от 27.07.2006, отправляя данную форму, вы подтверждаете свое <a href="/politika-konfidentsialnosti/">согласие на обработку персональных данных</a>.
                        <div class="error">Пожалуйста, предоставьте свое согласие на обработку персональных данных, отметив флажок</div></label>

                </div>
                <br>
            <input type="submit" class="recall_submit feedback-button callbackhead-button" value="<?php echo $_smarty_tpl->tpl_vars['rc_sys_settings']->value['dsubmit'];?>
"/>
        </form>
        <div class="recall_footer"></div>
    </div>
</div>
<?php }?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script>
        $(document).ready(function () {
            $(".recall_form").validate({
                messages: {
                    email: "Email адрес введен не правильно",
                }
            });
        });
</script><?php }} ?>