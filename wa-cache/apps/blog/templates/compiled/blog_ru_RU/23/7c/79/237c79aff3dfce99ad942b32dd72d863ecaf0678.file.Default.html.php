<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:20:48
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/layouts/Default.html" */ ?>
<?php /*%%SmartyHeaderCode:125941267459b0e5401d2052-89271158%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '237c79aff3dfce99ad942b32dd72d863ecaf0678' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/layouts/Default.html',
      1 => 1443175588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125941267459b0e5401d2052-89271158',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'title' => 0,
    'wa_app_static_url' => 0,
    'wa_url' => 0,
    'backend_assets' => 0,
    'item' => 0,
    'rights' => 0,
    'sidebar' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e540265949_02137880',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e540265949_02137880')) {function content_59b0e540265949_02137880($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/block.wa_js.php';
?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->title(), null, 0);?>
  <title><?php if ($_smarty_tpl->tpl_vars['title']->value){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['wa']->value->appName();?>
<?php }?> &mdash; <?php echo $_smarty_tpl->tpl_vars['wa']->value->accountName();?>
</title>
  <?php echo $_smarty_tpl->tpl_vars['wa']->value->css();?>

  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
css/blog.css?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
">
  <!--[if lte IE 9]>
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
css/blog.ie7.css">
  <![endif]-->
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.css?v=<?php echo $_smarty_tpl->tpl_vars['wa']->value->version();?>
">

  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.json.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.store.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.history.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.tmpl.min.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/ibutton/jquery.ibutton.min.js"></script>

  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.core.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-wa/wa.dialog.js"></script>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array('file'=>"js/blog.min.js")); $_block_repeat=true; echo smarty_block_wa_js(array('file'=>"js/blog.min.js"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

  <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/jquery.sticky.js
  <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/jquery.pageless2.js
  <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/blog.js
  <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/blogComments.js
  <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/jquery.form.js
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array('file'=>"js/blog.min.js"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

  <?php echo $_smarty_tpl->tpl_vars['wa']->value->js(false);?>

  
  
  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backend_assets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <?php echo $_smarty_tpl->tpl_vars['item']->value;?>

  <?php } ?>
  
  <script type="text/javascript">
  $.wa_blog = $.extend(true,$.wa_blog,{
    'rights':<?php echo json_encode($_smarty_tpl->tpl_vars['rights']->value);?>

  });
  </script>
</head>
<body>
  <div id="wa">
    <?php echo $_smarty_tpl->tpl_vars['wa']->value->header();?>

    <div id="wa-app">
      <?php echo $_smarty_tpl->tpl_vars['sidebar']->value;?>

      <div class="content left200px">
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

      </div>
    </div><!-- #wa-app -->
  </div><!-- #wa -->
</body>
</html><?php }} ?>