<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:29
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/actions/backend/Backend.html" */ ?>
<?php /*%%SmartyHeaderCode:97804908559b0e8ed4e3711-69394980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b4b56cb25710c66e1af8cd1ab03e1b63860fd0e' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/actions/backend/Backend.html',
      1 => 1419597237,
      2 => 'file',
    ),
    'd0d31abaea9d5535c96f9c5a5be6207e5cbda101' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/dialogs/postMove.html',
      1 => 1337156576,
      2 => 'file',
    ),
    '2b5045c87631785869aa620b677ac577c5d01803' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/dialogs/postDelete.html',
      1 => 1419597237,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97804908559b0e8ed4e3711-69394980',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'wa_app_static_url' => 0,
    'pages' => 0,
    'backend_stream' => 0,
    'output' => 0,
    'plugin' => 0,
    'text' => 0,
    'blog_id' => 0,
    'wa' => 0,
    'blogs' => 0,
    'blog_item' => 0,
    'move_blog_count' => 0,
    'stream' => 0,
    'posts' => 0,
    'post_id' => 0,
    'post' => 0,
    'contact_id' => 0,
    'post_link' => 0,
    'contact_rights' => 0,
    'wa_backend_url' => 0,
    'link' => 0,
    'cut_link_label' => 0,
    'p' => 0,
    'photos_loaded' => 0,
    'wa_url' => 0,
    'posts_count' => 0,
    'posts_total_count' => 0,
    'posts_per_page' => 0,
    'import_link' => 0,
    'dialogs' => 0,
    'dialog' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e8eda7e355_07950925',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e8eda7e355_07950925')) {function content_59b0e8eda7e355_07950925($_smarty_tpl) {?><?php if (!is_callable('smarty_block_wa_js')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/block.wa_js.php';
if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?><?php if ($_smarty_tpl->tpl_vars['page']->value==1){?>

  <?php $_smarty_tpl->smarty->_tag_stack[] = array('wa_js', array('file'=>"js/blog-stream.min.js")); $_block_repeat=true; echo smarty_block_wa_js(array('file'=>"js/blog-stream.min.js"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php echo $_smarty_tpl->tpl_vars['wa_app_static_url']->value;?>
js/blogStream.js
  <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wa_js(array('file'=>"js/blog-stream.min.js"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


  <script type="text/javascript">
  $.wa_blog.stream = $.extend(true,$.wa_blog.stream,{
    'options':{
      pageless:{
        url: location.href.replace(/[&\?]page=[\d]+/, ''),
        target: '.b-stream',
        count: <?php echo $_smarty_tpl->tpl_vars['pages']->value;?>

      }
    }
  });
  </script>

  <div class="b-stream">

    <div class="b-stream-title">

      <div class="float-right ie-menu-h-fix">
        <ul class="menu-h" id="blog-stream-primary-menu">

          
          <!-- plugin hook: "backend_stream.menu" -->
          <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['backend_stream']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
            <?php if (is_array($_smarty_tpl->tpl_vars['output']->value)&&isset($_smarty_tpl->tpl_vars['output']->value['menu'])){?>
            <li>
              <!-- begin <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 --><?php echo $_smarty_tpl->tpl_vars['output']->value['menu'];?>
<!-- end <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 -->
            </li>
            <?php }?>
          <?php } ?>
          <!-- end plugin hook: "backend_stream.menu" -->

          <li class="b-search-form">
            <input type="search" name="text" class="search" placeholder="Найти запись" value="<?php echo $_smarty_tpl->tpl_vars['text']->value;?>
">
          </li>

          <?php if ((empty($_smarty_tpl->tpl_vars['blog_id']->value)&&($_smarty_tpl->tpl_vars['wa']->value->blog->rights(false)>=blogRightConfig::RIGHT_READ_WRITE))||(!empty($_smarty_tpl->tpl_vars['blog_id']->value)&&($_smarty_tpl->tpl_vars['wa']->value->blog->rights($_smarty_tpl->tpl_vars['blog_id']->value)>=blogRightConfig::RIGHT_READ_WRITE))){?>
          <li>
            <a href="#manage" id="blog_manage_posts">
              <i class="icon16 hamburger"></i>
            </a>
          </li>
          <?php }?>



        </ul>
        <ul class="menu-h" id="blog-stream-manage-menu" style="display:none">
          <?php $_smarty_tpl->tpl_vars['move_blog_count'] = new Smarty_variable(0, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['blog_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blog_item']->_loop = false;
 $_smarty_tpl->tpl_vars['blog_item_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['blogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blog_item']->key => $_smarty_tpl->tpl_vars['blog_item']->value){
$_smarty_tpl->tpl_vars['blog_item']->_loop = true;
 $_smarty_tpl->tpl_vars['blog_item_id']->value = $_smarty_tpl->tpl_vars['blog_item']->key;
?>
          <?php if ($_smarty_tpl->tpl_vars['blog_item']->value['rights']>=blogRightConfig::RIGHT_READ_WRITE&&(!isset($_smarty_tpl->tpl_vars['blog_id']->value)||!$_smarty_tpl->tpl_vars['blog_id']->value||$_smarty_tpl->tpl_vars['blog_item']->value['id']!=$_smarty_tpl->tpl_vars['blog_id']->value)){?>
          <?php $_smarty_tpl->tpl_vars['move_blog_count'] = new Smarty_variable($_smarty_tpl->tpl_vars['move_blog_count']->value+1, null, 0);?>
          <?php }?><?php } ?>
          <?php if ($_smarty_tpl->tpl_vars['move_blog_count']->value>(!isset($_smarty_tpl->tpl_vars['blog_id']->value)||!$_smarty_tpl->tpl_vars['blog_id']->value ? 1 : 0)){?>
          <li>
            <a id="postmove-dialog-confirm" href="#" class="dialog-confirm">
              <i class="icon16 move"></i>Переместить в блог <span class="indicator js-blog-selected-posts-counter">0</span>
            </a>
            <?php $_smarty_tpl->_capture_stack[0][] = array('default', null, "dialogs"); ob_start(); ?>
              <?php /*  Call merged included template "./../../dialogs/postMove.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('./../../dialogs/postMove.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '97804908559b0e8ed4e3711-69394980');
content_59b0e8ed5ba227_67982174($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "./../../dialogs/postMove.html" */?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
          </li>
          <?php }?>
          <li>
            <a id="postdelete-dialog-confirm" href="#" class="dialog-confirm">
              <i class="icon16 delete"></i>Удалить <span class="indicator js-blog-selected-posts-counter">0</span>
            </a>
            <?php $_smarty_tpl->_capture_stack[0][] = array('default', null, "dialogs"); ob_start(); ?>
              <?php /*  Call merged included template "./../../dialogs/postDelete.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('./../../dialogs/postDelete.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('post'=>false), 0, '97804908559b0e8ed4e3711-69394980');
content_59b0e8ed62e048_91298216($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "./../../dialogs/postDelete.html" */?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
          </li>
          <li>
            <a href="#" class="js-manage-done inline-link gray"><b><i>Отмена</i></b></a>
          </li>
        </ul>
      </div>

      <h1>
        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['stream']->value['title'], ENT_QUOTES, 'UTF-8', true);?>


        <?php if ($_smarty_tpl->tpl_vars['stream']->value['blog']){?>
            <a href="?module=blog&action=settings&blog=<?php echo $_smarty_tpl->tpl_vars['stream']->value['blog']['id'];?>
" title="Настройки блога">
                <i class="icon16 settings"></i>
            </a>
        <?php }?>

      </h1>

    </div>
<?php }?>


<?php $_smarty_tpl->tpl_vars['contact_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->user()->get('id'), null, 0);?>
<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_smarty_tpl->tpl_vars['post_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post_id']->value = $_smarty_tpl->tpl_vars['post']->key;
?> <!-- post.id:<?php echo $_smarty_tpl->tpl_vars['post_id']->value;?>
  -->

  <div class="b-post <?php echo $_smarty_tpl->tpl_vars['post']->value['color'];?>
<?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']!=blogBlogModel::STATUS_PUBLIC){?> b-private-post<?php }?>" id="b-post-<?php echo $_smarty_tpl->tpl_vars['post_id']->value;?>
">
    <h3 style="display:none" class="b-post-title-bulk-mode">
      <?php if (($_smarty_tpl->tpl_vars['post']->value['rights']>=blogRightConfig::RIGHT_FULL)||($_smarty_tpl->tpl_vars['contact_id']->value==$_smarty_tpl->tpl_vars['post']->value['contact_id']&&$_smarty_tpl->tpl_vars['post']->value['rights']>=blogRightConfig::RIGHT_READ_WRITE)){?>
        <input type="checkbox" id="blog-post-checkbox-<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
" class="blog-post-checkbox" name="posts[]" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
">
      <?php }?>
      <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true);?>

    </h3>
    <h3>
      <?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']==blogBlogModel::STATUS_PUBLIC){?>
        <?php if (($_smarty_tpl->tpl_vars['post']->value['rights']>=blogRightConfig::RIGHT_FULL)||($_smarty_tpl->tpl_vars['contact_id']->value==$_smarty_tpl->tpl_vars['post']->value['contact_id']&&$_smarty_tpl->tpl_vars['post']->value['rights']>=blogRightConfig::RIGHT_READ_WRITE)){?>
          <?php $_smarty_tpl->tpl_vars['post_link'] = new Smarty_variable("?module=post&amp;id=".((string)$_smarty_tpl->tpl_vars['post']->value['id'])."&amp;action=edit", null, 0);?>
        <?php }else{ ?>
          <?php $_smarty_tpl->tpl_vars['post_link'] = new Smarty_variable(false, null, 0);?>
        <?php }?>
      <?php }else{ ?>
        <?php $_smarty_tpl->tpl_vars['post_link'] = new Smarty_variable("?module=post&amp;id=".((string)$_smarty_tpl->tpl_vars['post']->value['id']), null, 0);?>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['post_link']->value){?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['post_link']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['post']->value['new'])&&$_smarty_tpl->tpl_vars['post']->value['new']){?> class="highlighted"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</a>
      <?php }else{ ?>
        <span<?php if (isset($_smarty_tpl->tpl_vars['post']->value['new'])&&$_smarty_tpl->tpl_vars['post']->value['new']){?> class="highlighted"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</span>
      <?php }?>

      <?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']!=blogBlogModel::STATUS_PUBLIC){?>
        <i class="icon16 lock-bw" title="Закрытая запись"></i>
      <?php }?>

      <?php if (isset($_smarty_tpl->tpl_vars['post']->value['plugins'])&&isset($_smarty_tpl->tpl_vars['post']->value['plugins']['post_title'])&&$_smarty_tpl->tpl_vars['post']->value['plugins']['post_title']){?>

        
        <!-- plugin hook: "prepare_posts_backend.*.post_title" -->
        <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['post_title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>

          <!-- begin "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.post_title" -->
          <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

          <!-- end "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.post_title" -->
        <?php } ?>
        <!-- end plugin hook: "prepare_posts_backend.*.post_title" -->
      <?php }?>

      <?php if (isset($_smarty_tpl->tpl_vars['post']->value['plugins'])&&isset($_smarty_tpl->tpl_vars['post']->value['plugins']['post_title_right'])&&$_smarty_tpl->tpl_vars['post']->value['plugins']['post_title_right']){?>

        
        <!-- plugin hook: "prepare_posts_backend.*.post_title_right" -->
        <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['post_title_right']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>

          <!-- begin "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.post_title_right" -->
          <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

          <!-- end "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.post_title_right" -->
        <?php } ?>
        <!-- end plugin hook: "prepare_posts_backend.*.post_title_right" -->
      <?php }?>
    </h3>
    <div class="profile image20px">
      <div class="image">
      <?php if ($_smarty_tpl->tpl_vars['contact_rights']->value&&$_smarty_tpl->tpl_vars['post']->value['contact_id']){?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['wa_backend_url']->value;?>
contacts/#/contact/<?php echo $_smarty_tpl->tpl_vars['post']->value['contact_id'];?>
">
          <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" alt="" class="userpic">
        </a>
      <?php }else{ ?>
        <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" alt="" class="userpic">
      <?php }?>
      </div>
      <div class="details">

        <div class="b-post-credentials">
          <?php if ($_smarty_tpl->tpl_vars['contact_rights']->value&&$_smarty_tpl->tpl_vars['post']->value['contact_id']){?>
            <a class="hint b-gray-link" href="<?php echo $_smarty_tpl->tpl_vars['wa_backend_url']->value;?>
contacts/#/contact/<?php echo $_smarty_tpl->tpl_vars['post']->value['contact_id'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['user']['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
          <?php }else{ ?>
            <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['user']['name'], ENT_QUOTES, 'UTF-8', true);?>
</span>
          <?php }?>

          <span><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],"humandatetime");?>
</span>

          <?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']==blogBlogModel::STATUS_PUBLIC){?>
            <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['link']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
              <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" class="underline"><?php echo $_smarty_tpl->tpl_vars['link']->value;?>
</a>
            <?php } ?>
          <?php }else{ ?>
            <?php if ($_smarty_tpl->tpl_vars['post']->value['comment_new_count']>0){?>
              <a href="?module=post&amp;id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
#comments" class="underline<?php if (!$_smarty_tpl->tpl_vars['post']->value['comment_count']){?> gray<?php }?>"><?php echo _w('%d comment','%d comments',$_smarty_tpl->tpl_vars['post']->value['comment_count'],true);?>
</a>
              <strong class="highlighted">+<?php echo $_smarty_tpl->tpl_vars['post']->value['comment_new_count'];?>
</strong>
            <?php }elseif($_smarty_tpl->tpl_vars['post']->value['comment_count']){?>
              <a href="?module=post&amp;id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
#comments" class="underline<?php if (!$_smarty_tpl->tpl_vars['post']->value['comment_count']){?> gray<?php }?>"><?php echo _w('%d comment','%d comments',$_smarty_tpl->tpl_vars['post']->value['comment_count'],true);?>
</a>
            <?php }else{ ?><!-- no comments  -->
              <a href="?module=post&amp;id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
#comments" class="underline<?php if (!$_smarty_tpl->tpl_vars['post']->value['comment_count']){?> gray<?php }?>">Нет комментариев</a>
            <?php }?>
          <?php }?>

        </div>

      </div>
    </div>

    <div class="b-post-body">



    <?php if (isset($_smarty_tpl->tpl_vars['post']->value['plugins'])&&isset($_smarty_tpl->tpl_vars['post']->value['plugins']['before'])&&$_smarty_tpl->tpl_vars['post']->value['plugins']['before']){?>

      
      <!-- plugin hook: "prepare_posts_backend.*.before" -->
      <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['before']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>

        <!-- begin "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.before" -->
        <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        <!-- end "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.before" -->
      <?php } ?>
      <!-- end plugin hook: "prepare_posts_backend.*.before" -->
    <?php }?>

    <?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>

    <?php if ($_smarty_tpl->tpl_vars['post']->value['cutted']){?>
      <?php $_smarty_tpl->tpl_vars['cut_link_label'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['post']->value['cut_link_label'])===null||$tmp==='' ? 'Читать далее →' : $tmp), null, 0);?>
      <?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']==blogBlogModel::STATUS_PUBLIC&&count($_smarty_tpl->tpl_vars['post']->value['link'])){?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'][0];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['cut_link_label']->value;?>
</a>
        <i class="icon10 new-window"></i>
      <?php }else{ ?>
        <a href="?module=post&amp;id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['cut_link_label']->value;?>
</a>
      <?php }?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['post']->value['album_id']&&$_smarty_tpl->tpl_vars['post']->value['album']['id']){?>
        <div class="b-photo-album-attached">
            <?php $_smarty_tpl->tpl_vars['photos_loaded'] = new Smarty_variable(1, null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['post']->value['album']['photos']){?>
                <ul class="thumbs li100px">
                    <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['album']['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['album']['backend_link'];?>
photo/<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
/" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumb_crop']['url'];?>
" class="retinify" width="96" height="96" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"></a></li>
                    <?php } ?>
                </ul>
            <?php }?>
            <p><i class="icon16 pictures"></i><em> Фотоальбом: <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['album']['backend_link'];?>
" class="bold"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['album']['name'], ENT_QUOTES, 'UTF-8', true);?>
</a> (<?php echo count($_smarty_tpl->tpl_vars['post']->value['album']['photos']);?>
)</em></p>
        </div>
    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['post']->value['plugins'])&&isset($_smarty_tpl->tpl_vars['post']->value['plugins']['after'])&&$_smarty_tpl->tpl_vars['post']->value['plugins']['after']){?>

      
      <!-- plugin hook: "prepare_posts_backend.*.after" -->
      <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['after']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>

        <!-- begin "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.after" -->
        <?php echo $_smarty_tpl->tpl_vars['output']->value;?>

        <!-- end "prepare_posts_backend.<?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
.after" -->
      <?php } ?>
      <!-- end plugin hook: "prepare_posts_backend.*.after" -->
    <?php }?>
    </div>

  </div>

<?php } ?>

<?php if (!empty($_smarty_tpl->tpl_vars['photos_loaded']->value)&&blogPhotosBridge::is2xEnabled()){?>
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.retina.min.js"></script>
    <script>$(function() { "use strict";
        $.Retina && $('img.retinify').retina();
    });</script>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['posts_count']->value>0){?>
  <div class="block b-post b-number-of-posts <?php if ($_smarty_tpl->tpl_vars['stream']->value['blog']){?><?php echo $_smarty_tpl->tpl_vars['stream']->value['blog']['color'];?>
<?php }else{ ?>b-white<?php }?> pageless-wrapper">
    <?php echo sprintf(_w("%d post of %d","%d posts of %d",$_smarty_tpl->tpl_vars['posts_count']->value,false),$_smarty_tpl->tpl_vars['posts_count']->value,$_smarty_tpl->tpl_vars['posts_total_count']->value);?>

    <?php if ($_smarty_tpl->tpl_vars['posts_count']->value<$_smarty_tpl->tpl_vars['posts_total_count']->value){?>
      <br>
      <br>
      <a href="#next" class="pageless-link">Показать более ранние записи</a>
      <span class="pageless-progress" style="display:none"><i class="icon16 loading"></i>Загрузка&nbsp;<?php echo _w("%d post","%d posts",min($_smarty_tpl->tpl_vars['posts_total_count']->value-$_smarty_tpl->tpl_vars['posts_count']->value,$_smarty_tpl->tpl_vars['posts_per_page']->value));?>
...</span>
    <?php }?>
  </div>
<?php }else{ ?>
  <div class="block b-post b-empty-list <?php if ($_smarty_tpl->tpl_vars['stream']->value['blog']){?><?php echo $_smarty_tpl->tpl_vars['stream']->value['blog']['color'];?>
<?php }else{ ?>b-white<?php }?>">
    <?php if ($_smarty_tpl->tpl_vars['stream']->value['all_posts']){?>

        <div class="b-welcome">
            <h1>Добро пожаловать в ваш новый блог!</h1>
            <p>
                <?php if (empty($_smarty_tpl->tpl_vars['import_link']->value)){?>
                    <?php echo sprintf('Начните с <a href="%s">создания записи</a>.','?module=post&amp;action=edit&amp;id=');?>

                <?php }else{ ?>
                    <?php echo sprintf('Начните с <a href="%s">создания записи</a> или с <a href="%s">импорта записей</a><br> из вашего существующего блога.','?module=post&amp;action=edit&amp;id=',$_smarty_tpl->tpl_vars['import_link']->value);?>

                <?php }?>
            </p>
        </div>

    <?php }else{ ?>
      <p>Нет записей.</p>
    <?php }?>
  </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value>=$_smarty_tpl->tpl_vars['pages']->value){?>
  <div class="b-torn-paper <?php if ($_smarty_tpl->tpl_vars['stream']->value['blog']){?><?php echo $_smarty_tpl->tpl_vars['stream']->value['blog']['color'];?>
<?php }else{ ?>b-white<?php }?>">
    <div>
      <div class="b-torn-left"></div>
      <div class="b-torn"></div>
      <div class="b-torn-right"></div>
    </div>
  </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value==1){?>
  </div>

    <?php if (isset($_smarty_tpl->tpl_vars['dialogs']->value)&&$_smarty_tpl->tpl_vars['dialogs']->value){?>
      <!-- dialog begin -->
      <?php  $_smarty_tpl->tpl_vars['dialog'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dialog']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dialogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dialog']->key => $_smarty_tpl->tpl_vars['dialog']->value){
$_smarty_tpl->tpl_vars['dialog']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['dialog']->value;?>

      <?php } ?>
      <!-- dialog end -->
    <?php }?>

<?php }?><?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:29
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/dialogs/postMove.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0e8ed5ba227_67982174')) {function content_59b0e8ed5ba227_67982174($_smarty_tpl) {?><div class="dialog width300px height200px" id="postmove-dialog">
  <div class="dialog-background"> </div>
  <div class="dialog-window" style="height:130px; min-height: 130px; width: 500px; min-width: 350px">
    <div class="dialog-content">
      <div class="dialog-content-indent">
        <h1>Переместить записи</h1>
        <select name="blog_id">
          <?php  $_smarty_tpl->tpl_vars['blog_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blog_item']->_loop = false;
 $_smarty_tpl->tpl_vars['blog_item_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['blogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blog_item']->key => $_smarty_tpl->tpl_vars['blog_item']->value){
$_smarty_tpl->tpl_vars['blog_item']->_loop = true;
 $_smarty_tpl->tpl_vars['blog_item_id']->value = $_smarty_tpl->tpl_vars['blog_item']->key;
?>
          <?php if ($_smarty_tpl->tpl_vars['blog_item']->value['rights']>=blogRightConfig::RIGHT_READ_WRITE&&(!$_smarty_tpl->tpl_vars['blog_id']->value||$_smarty_tpl->tpl_vars['blog_item']->value['id']!=$_smarty_tpl->tpl_vars['blog_id']->value)){?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['blog_item_id']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blog_item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
          <?php }?><?php } ?>
        </select>
      </div>
    </div>
    <div class="dialog-buttons">
      <div class="dialog-buttons-gradient">
        <input type="button" name="delete" class="button green" value="Переместить записи">  или <a href="#" class="cancel">отменить</a>
      </div>
    </div>
  </div>
</div><?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:36:29
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/dialogs/postDelete.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0e8ed62e048_91298216')) {function content_59b0e8ed62e048_91298216($_smarty_tpl) {?><div class="dialog" id="postdelete-dialog">
  <div class="dialog-background"> </div>
  <div class="dialog-window" style="height: 180px; min-height: 180px; width: 400px; min-width: 400px">
    <div class="dialog-content">
      <div class="dialog-content-indent">
        <?php if (isset($_smarty_tpl->tpl_vars['post']->value)&&$_smarty_tpl->tpl_vars['post']->value){?>
          <h1>Удалить запись</h1>
          <p><?php echo sprintf('Запись «<b>%s</b>» будет удалена без возможности восстановления. Удалить?',htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['post']->value['title'])===null||$tmp==='' ? '(нет заголовка)' : $tmp), ENT_QUOTES, 'UTF-8', true));?>
</p>
        <?php }else{ ?>
          <h1>Удалить записи</h1>
          <p>Выбранные записи будут удалены без возможности восстановления. Удалить?</p>
        <?php }?>
      </div>
    </div>
    <div class="dialog-buttons">
      <div class="dialog-buttons-gradient">
        <input type="button" name="delete" class="button red" value="Удалить">
        или <a href="#" class="cancel">отменить</a>
      </div>
    </div>
  </div>
</div><?php }} ?>