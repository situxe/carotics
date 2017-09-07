<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:20:47
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/actions/backend/BackendSidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:113006205259b0e53fefde04-83210893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a678ecd7569799f08b61b92147a48496a787f9da' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/templates/actions/backend/BackendSidebar.html',
      1 => 1419597237,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113006205259b0e53fefde04-83210893',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa_url' => 0,
    'writable_blogs' => 0,
    'new_post' => 0,
    'view_all_posts' => 0,
    'wa_app_url' => 0,
    'post_count' => 0,
    'new_post_count' => 0,
    'module' => 0,
    'comment_count' => 0,
    'comment_new_count' => 0,
    'action' => 0,
    'count_draft_overdue' => 0,
    'backend_sidebar' => 0,
    'output' => 0,
    'plugin' => 0,
    'can_see_blog_settings' => 0,
    'blog_id_full_access' => 0,
    'blogs' => 0,
    'id' => 0,
    'blog_id' => 0,
    'blog' => 0,
    'drafts_count' => 0,
    'wa' => 0,
    'drafts' => 0,
    'post' => 0,
    'post_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e5401c3299_54496557',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e5401c3299_54496557')) {function content_59b0e5401c3299_54496557($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-ui/jquery.ui.sortable.min.js"></script>

  <div class="sidebar left200px">

    <div class="b-sidebar menu-collapsible">

      <!-- core navigation -->

      <div class="block">
        <ul class="menu-v with-icons category-menu">
          <?php if ($_smarty_tpl->tpl_vars['writable_blogs']->value){?>
          <li class="bottom-padded <?php if (isset($_smarty_tpl->tpl_vars['new_post']->value)&&$_smarty_tpl->tpl_vars['new_post']->value==true){?>selected<?php }?>">
            <a href="?module=post&amp;action=edit&amp;id="><i class="icon16 add"></i><strong>Новая запись</strong>
            </a>
          </li>
          <?php }?>
          <li <?php if (isset($_smarty_tpl->tpl_vars['view_all_posts']->value)&&$_smarty_tpl->tpl_vars['view_all_posts']->value==true){?>class="selected"<?php }?>>
            <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
">
              <span class="count "><?php echo $_smarty_tpl->tpl_vars['post_count']->value;?>
</span>
              <i class="icon16 blogs"></i>Все записи
              <?php if (isset($_smarty_tpl->tpl_vars['new_post_count']->value)&&$_smarty_tpl->tpl_vars['new_post_count']->value>0){?>
                <strong class="small highlighted">+<?php echo $_smarty_tpl->tpl_vars['new_post_count']->value;?>
</strong>
              <?php }?>
            </a>
          </li>
          <li <?php if ($_smarty_tpl->tpl_vars['module']->value=='comments'){?>class="selected"<?php }?>>
            <a href="?module=comments">
              <span class="count comment-count"><?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
</span>
              <i class="icon16 comments"></i>Комментарии
              <?php if ($_smarty_tpl->tpl_vars['comment_new_count']->value>0){?><strong class="small highlighted">+<?php echo $_smarty_tpl->tpl_vars['comment_new_count']->value;?>
</strong><?php }?>
            </a>
          </li>
          <li <?php if ($_smarty_tpl->tpl_vars['action']->value=='calendar'){?>class="selected"<?php }?>>
            <a href="?action=calendar">
              <?php if ($_smarty_tpl->tpl_vars['count_draft_overdue']->value>0){?><strong class="count indicator red"><?php echo $_smarty_tpl->tpl_vars['count_draft_overdue']->value;?>
</strong><?php }?>
              <i class="icon16 calendar"></i>Календарь
            </a>
          </li>
          
          <!-- plugin hook: "backend_sidebar.menu" -->
          <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['backend_sidebar']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
            <?php if (is_array($_smarty_tpl->tpl_vars['output']->value)&&isset($_smarty_tpl->tpl_vars['output']->value['menu'])){?>

              <!-- begin <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 --><?php echo $_smarty_tpl->tpl_vars['output']->value['menu'];?>
<!-- end <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 -->
            <?php }?>
          <?php } ?>

          <!-- end plugin hook: "backend_sidebar.menu" -->
        </ul>
      </div>

      <!-- blog list -->
      <div class="block">
      <?php if ($_smarty_tpl->tpl_vars['can_see_blog_settings']->value){?>
        <span class="count">
          <a href="?module=blog&amp;blog=&amp;action=settings&blog=<?php echo $_smarty_tpl->tpl_vars['blog_id_full_access']->value;?>
"><i class="icon16 settings"></i></a>
        </span>
      <?php }?>
        <h5 class="heading collapse-handler">
          <i class="icon16 darr"></i>Блоги
        </h5>
        <ul class="menu-v with-icons collapsible category-menu" id="blogs">
          <?php  $_smarty_tpl->tpl_vars['blog'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blog']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['blogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blog']->key => $_smarty_tpl->tpl_vars['blog']->value){
$_smarty_tpl->tpl_vars['blog']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['blog']->key;
?> <!-- blog list item <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
  -->
          <li <?php if (isset($_smarty_tpl->tpl_vars['blog_id']->value)&&$_smarty_tpl->tpl_vars['blog_id']->value==$_smarty_tpl->tpl_vars['id']->value&&$_smarty_tpl->tpl_vars['action']->value!='settings'){?>class="selected"<?php }?> id="blog_li_item_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
            <a href="?blog=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
              <span class="count">
                <?php echo $_smarty_tpl->tpl_vars['blog']->value['qty'];?>

              </span>
              <?php echo $_smarty_tpl->tpl_vars['blog']->value['icon_html'];?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['blog']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

              <?php if ($_smarty_tpl->tpl_vars['blog']->value['status']==blogBLogModel::STATUS_PRIVATE){?><i class="icon10 lock-bw no-overhanging" title="Закрытый блог"></i> <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['blog']->value['color']!='b-white'){?><i class="icon10 no-overhanging color <?php echo $_smarty_tpl->tpl_vars['blog']->value['color'];?>
"></i><?php }?>
              <?php if (isset($_smarty_tpl->tpl_vars['blog']->value['new_post'])){?><strong class="small highlighted">+<?php echo $_smarty_tpl->tpl_vars['blog']->value['new_post'];?>
</strong><?php }?>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>

      
      <!-- plugin hook: "backend_sidebar.section" -->
      <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['backend_sidebar']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
        <?php if (is_array($_smarty_tpl->tpl_vars['output']->value)&&isset($_smarty_tpl->tpl_vars['output']->value['section'])){?>

          <!-- begin <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 --><?php echo $_smarty_tpl->tpl_vars['output']->value['section'];?>
<!-- end <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 -->
        <?php }?>
      <?php } ?>

      <!-- end plugin hook: "backend_sidebar.section" -->

      <?php if ($_smarty_tpl->tpl_vars['writable_blogs']->value){?>
      <!-- drafts -->
      <div class="block">

        <h5 class="heading collapse-handler">
            <i class="icon16 darr"></i><span class="title b-all-drafts" style="display:none;">Черновики</span><?php if (!empty($_smarty_tpl->tpl_vars['drafts_count']->value['my'])){?><span class="title b-my-drafts" style="display:none;">Мои черновики</span><?php }?>
          <span id="b-all-drafts" class="count b-drafts-toggle" style="display:none;"><a href="javascript:void(0);" class="inline-link"><b><i>все</i></b></a></span>
          <?php if (!empty($_smarty_tpl->tpl_vars['drafts_count']->value['my'])){?>
              <span id="b-my-drafts" class="count b-drafts-toggle" style="display:none;"><a href="javascript:void(0);" data-contact-id="<?php echo $_smarty_tpl->tpl_vars['wa']->value->user('id');?>
" class="inline-link"><b><i>только мои</i></b></a></span>
          <?php }?>
          <span class="count b-all-drafts counter" style="display: none;"><?php if (!empty($_smarty_tpl->tpl_vars['drafts_count']->value['all'])){?><?php echo $_smarty_tpl->tpl_vars['drafts_count']->value['all'];?>
<?php }?></span>
          <?php if (!empty($_smarty_tpl->tpl_vars['drafts_count']->value['my'])){?>
              <span class="count b-my-drafts counter" style="display: none;"></span>
          <?php }?>
        </h5>

        <ul id="blog-drafts" class="menu-v with-icons b-drafts collapsible">

        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['drafts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
          <li <?php if ($_smarty_tpl->tpl_vars['post']->value['id']==$_smarty_tpl->tpl_vars['post_id']->value){?>class="selected"<?php }?> data-contact-id="<?php echo $_smarty_tpl->tpl_vars['post']->value['contact_id'];?>
">

            <a class="<?php if ($_smarty_tpl->tpl_vars['post']->value['status']==blogPostModel::STATUS_SCHEDULED){?>italic<?php }?>" href="?module=post&amp;action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
">
              <span class="count">
                  <?php if ($_smarty_tpl->tpl_vars['post']->value['status']==blogPostModel::STATUS_SCHEDULED){?>
                    <i class="icon16 clock"></i>
                  <?php }elseif($_smarty_tpl->tpl_vars['post']->value['status']==blogPostModel::STATUS_DEADLINE){?>
                    <i class="icon16 exclamation"></i>
                  <?php }?>
              </span>
              
              <i class="icon16 userpic20" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
')"></i><span class="<?php if (isset($_smarty_tpl->tpl_vars['post']->value['overdue'])){?>bold b-draft-overdue<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['post']->value['color'])&&$_smarty_tpl->tpl_vars['post']->value['color']!='b-white'){?> <?php echo $_smarty_tpl->tpl_vars['post']->value['color'];?>
<?php }?>"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true),80);?>
</span>
              <?php if ($_smarty_tpl->tpl_vars['post']->value['blog_status']==blogBlogModel::STATUS_PRIVATE){?>
                <i class="icon10 lock-bw no-overhanging" title="Принадлежит частному блогу"></i>
              <?php }?>
              <?php if ($_smarty_tpl->tpl_vars['post']->value['datetime']){?>
                <br>
                <span class="hint<?php if (isset($_smarty_tpl->tpl_vars['post']->value['overdue'])){?> b-draft-overdue<?php }?>"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],'humandate');?>
</span>
              <?php }?>
            </a>

          </li>

        <?php } ?>
        </ul>

      </div>
      <?php }?>

      <div class="hr"></div>

      <!-- not-that-frequently-accessed app sections -->
      <div class="block">
        <ul class="menu-v with-icons">
            <?php if ($_smarty_tpl->tpl_vars['wa']->value->user()->getRights($_smarty_tpl->tpl_vars['wa']->value->app(),'pages')){?>
            <li <?php if ($_smarty_tpl->tpl_vars['module']->value=='pages'){?>class="selected"<?php }?>><a href="?module=pages"><i class="icon16 notebook"></i>Страницы</a></li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['wa']->value->user()->getRights($_smarty_tpl->tpl_vars['wa']->value->app(),'design')){?>
            <li <?php if ($_smarty_tpl->tpl_vars['module']->value=='design'||$_smarty_tpl->tpl_vars['module']->value=='themes'){?>class="selected"<?php }?>><a href="?module=design"><i class="icon16 design"></i>Дизайн</a></li>
            <?php }?>
            <li class="top-padded<?php if ($_smarty_tpl->tpl_vars['module']->value=='settings'){?> selected<?php }?>"><a href="?module=settings"><i class="icon16 settings"></i>Настройки</a></li>

            <?php if ($_smarty_tpl->tpl_vars['wa']->value->user()->isAdmin($_smarty_tpl->tpl_vars['wa']->value->app())){?>
                <li<?php if ($_smarty_tpl->tpl_vars['action']->value=='plugins'){?> class="selected"<?php }?>><a href="?module=plugins"><i class="icon16 plugins"></i>Плагины</a></li>
            <?php }?>

            
            <!-- plugin hook: "backend_sidebar.system" -->
            <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['backend_sidebar']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
            <?php if (is_array($_smarty_tpl->tpl_vars['output']->value)&&isset($_smarty_tpl->tpl_vars['output']->value['system'])){?>
              <!-- begin <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 --><?php echo $_smarty_tpl->tpl_vars['output']->value['system'];?>
<!-- end <?php echo $_smarty_tpl->tpl_vars['plugin']->value;?>
 -->
            <?php }?>
            <?php } ?>
            <!-- end plugin hook: "backend_sidebar.system" -->
        </ul>
      </div>

    </div>
  </div>

<script>(function() {
    // Make sure collapsible sections collapse immidiately.
    // Delaying this to page load time makes things flicker.
    $(".menu-collapsible .collapse-handler").each(function() {
        $.wa_blog.sidebar.restore(this);
    });
})();</script>
<?php }} ?>