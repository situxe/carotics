<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:23:55
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/site/templates/layouts/Default.html" */ ?>
<?php /*%%SmartyHeaderCode:182575055659b0e5fbe04f09-72323710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbe58904375ea33f2e8dae0da24c2f7f4e38f4c8' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/site/templates/layouts/Default.html',
      1 => 1453294823,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182575055659b0e5fbe04f09-72323710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'wa_app_static_url' => 0,
    'wa_url' => 0,
    'domain_id' => 0,
    'domains' => 0,
    'domain_root_url' => 0,
    'domain_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e5fbebd291_89339942',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e5fbebd291_89339942')) {function content_59b0e5fbebd291_89339942($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
 — <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</title>
<?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>

<link href="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
css/site.css?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
" rel="stylesheet" type="text/css" />

<script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/site.min.js"v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
 type="text/javascript"></script>

<script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/ace/ace.js?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version(true);?>
"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/editor.js?v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version(true);?>
"></script>

<script type="text/javascript" src="?action=loc&amp;v<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
"></script>
</head>
<body>
<div id="wa"<?php if (substr($_smarty_tpl->tpl_vars['domains']->value[$_smarty_tpl->tpl_vars['domain_id']->value]['style'],0,1)=='.'){?>style="background:url(<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-data/public/site/background/<?php echo $_smarty_tpl->tpl_vars['domain_id']->value;?>
<?php echo $_smarty_tpl->tpl_vars['domains']->value[$_smarty_tpl->tpl_vars['domain_id']->value]['style'];?>
)"<?php }else{ ?> class="s-<?php echo $_smarty_tpl->tpl_vars['domains']->value[$_smarty_tpl->tpl_vars['domain_id']->value]['style'];?>
"<?php }?>>

	<?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>

	<div id="wa-app">
		<div class="sidebar left200px s-sidebar">
			<?php echo $_smarty_tpl->getSubTemplate ("templates/layouts/Sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		</div>
		<div class="content left200px">
			<div id="s-content" class="shadowed s-content">
				<div class="block triple-padded">
				  Загрузка...
				  <i class="icon16 loading"></i>
		        </div>
			</div>
		</div>
	</div>

	<div id="s-save-panel" style="display:none" class="s-bottom-fixed-bar" >
		<div class="s-bottom-fixed-bar-content-offset">
			<div class="s-dropdown">
				<div class="s-drop-link">
					<a class="inline-link" id="s-helper-link" href="#">
						<i class="icon16 cheatsheet"></i><b><i>Шпаргалка</i></b>
						<i class="icon10 uarr no-overhanging"></i>
					</a>
					<div id="s-helper" class="s-dropdown-block"></div>
				</div>
			</div>
			<div class="block">
				<input id="s-editor-save-button" type="button" class="button green" value="Сохранить">
				<em class="hint">Ctrl + S</em>
				<span id="wa-editor-status" style="margin-left: 20px; display: none"></span>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$.wa.site.init({
        domain: <?php echo $_smarty_tpl->tpl_vars['domain_id']->value;?>
, static_url: "<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
",
        wa_url: "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
", root_url: "<?php echo $_smarty_tpl->tpl_vars['domain_root_url']->value;?>
",
        domain_url: "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['domain_url']->value, ENT_QUOTES, 'UTF-8', true);?>
"
    });
    var wa_url = "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
";
	</script>
</div>
</body>
</html><?php }} ?>