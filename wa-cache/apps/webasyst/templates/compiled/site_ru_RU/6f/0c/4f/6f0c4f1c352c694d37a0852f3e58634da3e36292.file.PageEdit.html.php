<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:23:57
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/page/templates/PageEdit.html" */ ?>
<?php /*%%SmartyHeaderCode:46446731259b0e5fd8a0080-49508317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f0c4f1c352c694d37a0852f3e58634da3e36292' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/page/templates/PageEdit.html',
      1 => 1452519810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46446731259b0e5fd8a0080-49508317',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'options' => 0,
    'k' => 0,
    'v' => 0,
    'backend_page_edit' => 0,
    '_' => 0,
    'url' => 0,
    'preview_hash' => 0,
    'page_route' => 0,
    'params' => 0,
    'n' => 0,
    'vars' => 0,
    'p' => 0,
    'og_params' => 0,
    'page_edit' => 0,
    'other_params' => 0,
    'wa' => 0,
    'wa_url' => 0,
    'lang' => 0,
    'page_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e5fe30e385_08703686',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e5fe30e385_08703686')) {function content_59b0e5fe30e385_08703686($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><div class="wa-page-editor">
<form id="wa-page-form" method="post" action="?module=pages&action=save<?php if ($_smarty_tpl->tpl_vars['page']->value){?>&id=<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
<?php }?>">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['options']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8', true);?>
">
    <?php } ?>
    <div class="block wa-page-gray-toolbar">
        <?php if ($_smarty_tpl->tpl_vars['page']->value){?>
        <div class="float-right ie-menu-h-fix">
            <ul class="menu-h">

                <!-- plugin hook: 'backend_page_edit.action_button_li' -->
                
                <?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_page_edit']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo ifset($_smarty_tpl->tpl_vars['_']->value['action_button_li']);?>
<?php } ?>

                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['update_datetime'])){?>
                    <li><h3 class="gray"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['page']->value['update_datetime'],"humandatetime");?>
</h3></li>
                <?php }?>
                <li><a href="#" class="inline-link" id="wa-page-settings-toggle"><i class="icon16 edit"></i><b><i>Настройки страницы</i></b></a></li>
                <li><a class="wa-page-delete" href="?module=pages&action=delete"><i class="icon16 delete"></i>Удалить</a></li>
            </ul>
        </div>
        <script type="text/javascript">
            $(".wa-page-delete").click(function () {
                if (confirm('Будет удалена вся страница. Продолжить?')) {
                    $.post($(this).attr('href'), { id:<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
}, function () {
                        
                        var li = $("#page-<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
");
                        var prev = li.prevAll('.dr:first');
                        if (prev.length > 0) {
                            location.href = prev.addClass('selected').find('a').attr('href');
                            li.remove();
                        } else {
                            next = li.nextAll('.dr:first');
                            if (next.length > 0) {
                                location.href = next.addClass('selected').find('a').attr('href');
                                li.remove();
                            } else {
                                location.reload(true);
                            }
                        }
                    }, "json");
                }
                return false;
            });
        </script>
        <?php }?>
        <div>
            <h2 class="wa-page-name"><?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if (!$_smarty_tpl->tpl_vars['page']->value['status']){?> <span class="wa-page-draft">черновик</span><?php }?><?php }else{ ?>Новая страница<?php }?></h2>
            <div class="wa-page-urls small">
                <?php if ($_smarty_tpl->tpl_vars['page']->value){?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['url']->value)){?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['url'];?>
?preview=<?php echo $_smarty_tpl->tpl_vars['preview_hash']->value;?>
" title="Предпросмотр" target="_blank"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['url'];?>
</a>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['url'];?>
?preview=<?php echo $_smarty_tpl->tpl_vars['preview_hash']->value;?>
" target="_blank"><i class="icon10 new-window"></i></a>
                    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['domain']&&$_smarty_tpl->tpl_vars['page']->value['route']!==null){?>
                        <?php $_smarty_tpl->tpl_vars['page_route'] = new Smarty_variable(waRouting::clearUrl($_smarty_tpl->tpl_vars['page']->value['route']), null, 0);?>
                        <a style="text-decoration: line-through;" href="http://<?php echo $_smarty_tpl->tpl_vars['page']->value['domain'];?>
/<?php echo $_smarty_tpl->tpl_vars['page_route']->value;?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['full_url'];?>
?preview=<?php echo $_smarty_tpl->tpl_vars['preview_hash']->value;?>
" title="Предпросмотр" target="_blank">http://<?php echo $_smarty_tpl->tpl_vars['page']->value['domain'];?>
<?php echo $_smarty_tpl->tpl_vars['page_route']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['page']->value['full_url'];?>
</a>
                        <a href="http://<?php echo $_smarty_tpl->tpl_vars['page']->value['domain'];?>
/<?php echo $_smarty_tpl->tpl_vars['page_route']->value;?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['full_url'];?>
?preview=<?php echo $_smarty_tpl->tpl_vars['preview_hash']->value;?>
"><i class="icon10 new-window"></i></a>
                    <?php }else{ ?>
                    Страница не опубликована, потому что не прикреплена ни к одному поселению приложения (правилу маршрутизации). Перетащите страницу из секции «Неопубликованные», чтобы подключить ее к существующему правилу маршрутизации.
                    <?php }?>
                <?php }?>
                <br />
            </div>
        </div>
        <div id="wa-page-settings" style="<?php if ($_smarty_tpl->tpl_vars['page']->value){?>display: none;<?php }?>">
            <div class="fields form">
                <div class="field-group">
                    <div class="field">
                        <div class="name bold">Название страницы</div>
                        <div class="value">
                            <input type="text" class="bold large long" name="info[name]" value="<?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="value wa-ibutton-checkbox">
                            <ul class="menu-h">
                                <li><span id="wa-page-v-open-label" class="wa-page-gray">Черновик</span></li>
                                <li><input type="checkbox" id="wa-page-v" name="info[status]" <?php if (!$_smarty_tpl->tpl_vars['page']->value||$_smarty_tpl->tpl_vars['page']->value['status']){?>checked="checked"<?php }?> /></li>
                                <li><span id="wa-page-v-private-label">Опубликовано</span></li>
                            </ul>

                        </div>
                        <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['id'])){?>
                        <div class="value gray">
                            id: <strong><?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
</strong>
                        </div>
                        <?php }?>
                    </div>

                    <div class="field wa-page-url">
                        <div class="name bold">URL страницы</div>
                        <div class="value wa-page-app-url no-shift">
                            <?php if (!empty($_smarty_tpl->tpl_vars['url']->value)){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?><input type="text" name="info[url]" class="bold" value="<?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" />
                        </div>
                        <?php if (empty($_smarty_tpl->tpl_vars['url']->value)){?>
                        <div class="value small wa-page-app-url no-shift">
                            <span style="color: red;">Страница не опубликована, потому что не прикреплена ни к одному поселению приложения (правилу маршрутизации). Перетащите страницу из секции «Неопубликованные», чтобы подключить ее к существующему правилу маршрутизации.</span>
                        </div>
                        <?php }?>
                    </div>

                </div>

                <?php if (!$_smarty_tpl->tpl_vars['page']->value||!$_smarty_tpl->tpl_vars['page']->value['id']){?>
                <a id="wa-page-advanced-params-link" href="#" class="hint inline-link"><b><i>еще</i></b><i class="icon10 darr"></i></a>
                <div id="wa-page-advanced-params" style="display:none">
                    <?php }?>
                    <div class="field-group">
                        <div class="field">
                            <div class="name"><strong class="title">Заголовок</strong> <span class="hint">&lt;title&gt;</span></div>
                            <div class="value"><input type="text" name="info[title]" value="<?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>" class="bold long" /></div>
                        </div>
                        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['params']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['n']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
                        <div class="field">
                            <div class="name"><?php echo $_smarty_tpl->tpl_vars['vars']->value[$_smarty_tpl->tpl_vars['n']->value];?>
</div>
                            <?php if ($_smarty_tpl->tpl_vars['n']->value=='description'){?>
                            <div class="value"><textarea name="params[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
]"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea></div>
                            <?php }else{ ?>
                            <div class="value"><input type="text" name="params[<?php echo $_smarty_tpl->tpl_vars['n']->value;?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value, ENT_QUOTES, 'UTF-8', true);?>
" /></div>
                            <?php }?>
                        </div>
                        <?php } ?>
                        <div class="field">
                            <div class="name">Соцсети</div>
                            <div class="value no-shift">
                                <label><input class="og-checkbox" type="checkbox" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>checked<?php }?>> Для соцсетей использовать эти же заголовки и описания</label>
                            </div>
                        </div>
                    </div>

                    <div class="field-group og-group" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>style="display: none;"<?php }?>>
                        <div class="field">
                            <div class="name">Заголовок для соцсетей <span class="hint">og:title</span></div>
                            <div class="value">
                                <input name="og[title]" class="long bold" value="<?php echo htmlspecialchars(ifset($_smarty_tpl->tpl_vars['og_params']->value['title'],''), ENT_QUOTES, 'UTF-8', true);?>
" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>disabled<?php }?>>
                            </div>
                        </div>
                        <div class="field">
                            <div class="name">URL изображения для соцсетей <span class="hint">og:image</span></div>
                            <div class="value">
                                <input name="og[image]" class="long" value="<?php echo htmlspecialchars(ifset($_smarty_tpl->tpl_vars['og_params']->value['image'],''), ENT_QUOTES, 'UTF-8', true);?>
" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>disabled<?php }?>>
                                <br>
                                <span class="hint">Если адрес не указан явно, соцсеть автоматически выберет одно из изображений на странице</span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="name">URL видео для соцсетей <span class="hint">og:video</span></div>
                            <div class="value">
                                <input name="og[video]" class="long" value="<?php echo htmlspecialchars(ifset($_smarty_tpl->tpl_vars['og_params']->value['video'],''), ENT_QUOTES, 'UTF-8', true);?>
" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>disabled<?php }?>>
                            </div>
                        </div>
                        <div class="field">
                            <div class="name">Описание для соцсетей <span class="hint">og:description</span></div>
                            <div class="value">
                                <textarea name="og[description]"<?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>disabled<?php }?>><?php echo htmlspecialchars(ifset($_smarty_tpl->tpl_vars['og_params']->value['description'],''), ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                            </div>
                        </div>
                        <div class="field">
                            <div class="name">Тип страницы для соцсетей <span class="hint">og:type</span></div>
                            <div class="value">
                                <input name="og[type]" placeholder="" value="<?php echo ifset($_smarty_tpl->tpl_vars['og_params']->value['type'],'');?>
" <?php if (empty($_smarty_tpl->tpl_vars['og_params']->value)){?>disabled<?php }?>>
                            </div>
                        </div>

                        <div class="field">
                            <div class="value">
                                <span class="hint">Подробная информация о параметрах для соцсетей и их возможных значениях опубликована на сайте протокола <a href="http://ogp.me" target="_blank">Open Graph</a>.</span>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($_smarty_tpl->tpl_vars['page_edit']->value)){?>
                    <div class="field-group">
                    <?php  $_smarty_tpl->tpl_vars['_'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page_edit']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_']->key => $_smarty_tpl->tpl_vars['_']->value){
$_smarty_tpl->tpl_vars['_']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['_']->value;?>
<?php } ?>
                    </div>
                    <?php }?>

                    <div class="field">
                        <div class="name">Дополнительные параметры страницы</div>
                        <div class="value">
                            <textarea name="other_params"><?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['other_params']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8', true);?>

<?php } ?><?php }?></textarea><br />
                            <span class="hint">Необязательный набор параметров вида <em>key=value</em>, к значениям которых можно обращаться в шаблоне page.html или в содержимом текущей страницы как <em>&#123;$page.key&#125;</em>. Каждая пара key=value должна быть указана на отдельной строке. <a href="http://www.webasyst.ru/developers/docs/features/page-parameters/" target="_blank">Помощь</a> <i class="icon10 new-window"></i></span>
                        </div>
                    </div>
                    <?php if (!$_smarty_tpl->tpl_vars['page']->value||!$_smarty_tpl->tpl_vars['page']->value['id']){?>
                </div>
                <script type="text/javascript">
                    $("#wa-page-advanced-params-link").click(function () {
                        $("#wa-page-advanced-params").show();
                        $(this).remove();
                        return false;
                    });
                </script>
                <?php }?>
            </div>
            <br clear="left" />
        </div>
    </div>
    <div class="wa-editor-core-wrapper">
        <ul class="wa-editor-wysiwyg-html-toggle">
            <li class="selected"><a class="wysiwyg" href="#">Визуальный редактор</a></li>
            <li><a class="html" href="#">HTML</a></li>
        </ul>
        <div style="clear:both">
            <textarea style="display:none" id="wa-page-content" name="info[content]"><?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['content'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?></textarea>
        </div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['options']->value['save_panel']){?>
    <div class="wa-page-save-panel block bordered-top">
        <div class="wa-dropdown">
            <div class="wa-drop-link">
                <a class="inline-link" id="wa-editor-help-link" href="#">
                    <i class="icon16 cheatsheet"></i><b><i>Шпаргалка</i></b>
                    <i class="icon10 uarr no-overhanging"></i>
                </a>
                <div id="wa-editor-help" class="wa-dropdown-block"></div>
                <script type="text/javascript">
                    $("#wa-editor-help-link").click(function () {
                        if ($("#wa-editor-help").is(":visible")) {
                            $("#wa-editor-help").hide();
                            return false;
                        }
                        $("#wa-editor-help").load('?module=pages&action=help', "app=<?php echo $_smarty_tpl->tpl_vars['wa']->value->app();?>
&id=<?php if ($_smarty_tpl->tpl_vars['page']->value){?><?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
<?php }?>", function () {
                            $(this).show();
                            var f = function (e) {
                                if ($(e.target).attr('id') == 'wa-editor-help' || $(e.target).parents('#wa-editor-help').length) {
                                    $(document).one('click', f);
                                } else {
                                    $("#wa-editor-help").hide();
                                }
                            };
                            $(document).one('click', f);
                        });
                        return false;
                    });

                    $("#wa-editor-help").on('click', "div.fields a.inline-link", function () {
                        var el = $(this).find('i');
                        if (el.children('b').length) {
                            el = el.children('b');
                        }
                        $('#wa-page-content').waEditor('insert.html', el.text());
                        return false;
                    });
                </script>
            </div>
        </div>
        
        <input id="wa-page-button" type="submit" class="button green" value="Сохранить" />
        <em class="hint">Ctrl + S</em>
        <span id="wa-editor-status" style="margin-left: 25px; display: none"></span>

    </div>
    <?php }?>
<?php echo $_smarty_tpl->tpl_vars['wa']->value->csrf();?>

</form>
<div class="clear"></div>
</div>

<script type="text/javascript">
    var wa_url = "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
";
    var wa_app = "<?php echo $_smarty_tpl->tpl_vars['wa']->value->app();?>
";

    $(function () {
        $('.og-checkbox').change(function () {
            if ($(this).is(':checked')) {
                $('.og-group').hide().find('input,textarea').attr('disabled', 'disabled');
            } else {
                $('.og-group').show().find('input,textarea').removeAttr('disabled');
            }
        });
        <?php if ($_smarty_tpl->tpl_vars['options']->value['is_ajax']){?>
            <?php if ($_smarty_tpl->tpl_vars['page']->value){?>
            document.title = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 — <?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
";
            <?php }else{ ?>
            document.title = "Новая страница — <?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
";
            <?php }?>
        <?php }?>

        $('#wa-page-content').waEditor({
            lang: "<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
",
            saveButton: '#wa-page-button',
            uploadFields: {
                '_csrf': "<?php echo waRequest::cookie('_csrf','');?>
"
            }
        });


        var iButtonInit = function () {
            $("#wa-page-v").iButton({
                labelOn: "",
                labelOff: "",
                classContainer: 'ibutton-container mini'
            });
        };
        if ($("#wa-page-settings").is(":visible")) {
            setTimeout(iButtonInit, 200);
        } else {
            $("#wa-page-settings-toggle").one('click', function () {
                setTimeout(iButtonInit, 100);
            });
        }
        var status_check = function(item) {
            if ($(item).is(':checked')) {
                $('#wa-page-v-open-label').addClass('wa-page-gray');
                $('#wa-page-v-private-label').removeClass('wa-page-gray');
            } else {
                $('#wa-page-v-open-label').removeClass('wa-page-gray');
                $('#wa-page-v-private-label').addClass('wa-page-gray');
            }
        };
        status_check($('#wa-page-v'));
        $('#wa-page-v').change(function(){
            $('#wa-page-button').removeClass('green').addClass('yellow');
            status_check(this);
        });

        $('#wa-page-settings-toggle').click(function(){
            $('#wa-page-settings').toggle();
            return false;
        });

        <?php if ((!$_smarty_tpl->tpl_vars['page']->value||!$_smarty_tpl->tpl_vars['page']->value['id'])&&empty($_smarty_tpl->tpl_vars['options']->value['disable_auto_url'])){?>
            $.fn.onKeyFinish = function (defer, callback) {
                return this.each(function () {
                    var that = $(this);
                    that.currentValue = that.val();
                    that.interval = null;
                    $(this).off('keyup.wapages');
                    $(this).on('keyup.wapages', function (e) {
                        clearInterval(that.interval);
                        if (that.currentValue != that.val()) {
                            that.interval = setInterval(function () {
                                clearInterval(that.interval);
                                callback.call(that);
                                that.currentValue = that.val();
                            }, defer);
                        }
                    });
                });
            };
            $("#wa-page-settings input:first").focus();
            $('#wa-page-settings input[name="info[name]"]').onKeyFinish(300, function () {
                if (!$("#wa-page-form-translit").length) {
                    $("#wa-page-form").append('<input id="wa-page-form-translit" type="hidden" name="translit" value="1">');
                }
                var url = $('#wa-page-settings input[name="info[url]"]');
                if ($(this).val() && (!url.val() || !url.data('changed'))) {
                    $.post("?module=pages&action=translit", { str: $(this).val()}, function (response) {
                        $("#wa-page-form-translit").remove();
                        if (response.status == 'ok') {
                            if (!url.val() || !url.data('changed')) {
                                url.val(response.data.str);
                            }
                        }
                    }, "json");
                }
            });
            $('#wa-page-settings input[name="info[url]"]').on('keyup', function () {
               $(this).data('changed', 1);
            });
        <?php }?>

        $("#wa-page-form").submit(function () {
            if ($('#wa-page-settings input[name="info[name]"]').is(":focus")) {
                if (!$("#wa-page-form-translit").length) {
                    $("#wa-page-form").append('<input id="wa-page-form-translit" type="hidden" name="translit" value="1">');
                }
            }
            $('#wa-page-content').waEditor('sync');
            var form = $(this);
            var li = $(".block-pages ul li.selected");
            $("#wa-editor-status").html("<i class='icon16 loading'></i> Сохранение...").fadeIn("slow");
            $.post(form.attr('action'), form.serialize(), function (response) {
            if (response.status == 'ok') {
                $(".error").removeClass('error');
                $("#wa-editor-status").html('<i class="icon16 yes"></i> Сохранено').fadeOut('slow');
                $('#wa-page-button').removeClass('yellow').removeClass('red').addClass('green');
                var p = response.data;
                if (!p.status) {
                    p.name += ' <span class="wa-page-draft">черновик</span>';
                }
                var html = $('<li id="page-' + p.id + '" class="dr selected">' +
                '<a class="wa-page-link" href="<?php echo $_smarty_tpl->tpl_vars['page_url']->value;?>
' + p.id + '">' +
                '<span class="count"><i class="icon10 add wa-page-add"></i></span>' +
                '<i class="icon16 notebook"></i>' + p.name + ' <span class="hint">/' + p.full_url +'</span>' + '</a></li>');
                if (p.add) {
                    li.replaceWith(html);
                } else {
                    $("#page-" + p.id).children('a.wa-page-link').replaceWith($(html).find('a.wa-page-link'));
                    $("#page-" + p.id + ' > ul li span.hint').each(function () {
                        $(this).text('/' + p.full_url + (p.full_url.length > 0 && p.full_url.substr(-1) != '/' ? '/' : '') + $(this).text().substr(p.old_full_url.length + 1));
                    });
                }
                if (response.data.add) {
                    waLoadPage(p.id);
                } else {
                    $(".wa-page-editor h2.wa-page-name").html(p.name);
                }
                <?php if (!empty($_smarty_tpl->tpl_vars['url']->value)){?>
                var page_url = '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8', true);?>
' + p.url;
                <?php }elseif(isset($_smarty_tpl->tpl_vars['page_route']->value)){?>
                var page_url = 'http://<?php echo $_smarty_tpl->tpl_vars['page']->value['domain'];?>
/<?php echo $_smarty_tpl->tpl_vars['page_route']->value;?>
' + p.full_url;
                <?php }?>

                if ($(".wa-page-urls a").length) {
                    $(".wa-page-urls a").attr('href', page_url + '?preview=<?php echo $_smarty_tpl->tpl_vars['preview_hash']->value;?>
');
                    $(".wa-page-urls a:first").html(page_url);
                }
            } else if (response.status == 'fail') {
                if ($.isArray(response.errors)) {
                    var e = response.errors[0];
                    $(response.errors[1]).addClass('error');
                } else {
                    var e = response.errors;
                }
                $("#wa-editor-status").html('<b style="color:red">' + (e ? e : $_('An error occurred while saving')) + '</b>');
                $('#wa-page-button').removeClass('yellow').removeClass('green').addClass('red');
            }
            }, "json");
            return false;
        });
    });
</script>

<?php }} ?>