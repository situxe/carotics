<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:37:13
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream.html" */ ?>
<?php /*%%SmartyHeaderCode:121804159059b0e919099d29-99610961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c066b0467b15c0bd6d61bcff19d3eb317485fc9' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream.html',
      1 => 1350036304,
      2 => 'file',
    ),
    'c696325a926cac99a21d9fec19bc322dd2d39a1d' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream_search.html',
      1 => 1350036304,
      2 => 'file',
    ),
    'd83ab91ec13d0373cf720faab8d205d17a999421' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream_posts.html',
      1 => 1427265803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121804159059b0e919099d29-99610961',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_lazyloading' => 0,
    'wa' => 0,
    'stream_title' => 0,
    'page' => 0,
    'is_search' => 0,
    'pages' => 0,
    'posts' => 0,
    'posts_per_page' => 0,
    'loaded_post_count' => 0,
    'post_count' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e919311f10_07890368',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e919311f10_07890368')) {function content_59b0e919311f10_07890368($_smarty_tpl) {?>

<?php if (!$_smarty_tpl->tpl_vars['is_lazyloading']->value){?>
<div id="post-stream" role="main" class="lazyloading" <?php if ($_smarty_tpl->tpl_vars['wa']->value->param('blog_url')){?>itemscope itemtype="http://schema.org/Blog"<?php }?>>
<?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['is_lazyloading']->value&&!empty($_smarty_tpl->tpl_vars['stream_title']->value)){?><h1><?php echo $_smarty_tpl->tpl_vars['stream_title']->value;?>
</h1><?php }?>
    <a name="page_<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"></a>

        <?php if ($_smarty_tpl->tpl_vars['is_search']->value){?>
            <?php /*  Call merged included template "stream_search.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("stream_search.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '121804159059b0e919099d29-99610961');
content_59b0e9190f2e23_89889207($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "stream_search.html" */?>
        <?php }else{ ?>
            <?php /*  Call merged included template "stream_posts.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("stream_posts.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '121804159059b0e919099d29-99610961');
content_59b0e91915df34_99053167($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "stream_posts.html" */?>
        <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['is_lazyloading']->value||($_smarty_tpl->tpl_vars['page']->value==1)){?>
        <div class="pageless-wrapper"<?php if (!$_smarty_tpl->tpl_vars['is_lazyloading']->value){?> style="display:none;"<?php }?>>

        <?php if ($_smarty_tpl->tpl_vars['page']->value<$_smarty_tpl->tpl_vars['pages']->value){?>
            <?php $_smarty_tpl->tpl_vars['loaded_post_count'] = new Smarty_variable((count($_smarty_tpl->tpl_vars['posts']->value)+$_smarty_tpl->tpl_vars['posts_per_page']->value*($_smarty_tpl->tpl_vars['page']->value-1)), null, 0);?>
            <?php echo _w('%d post','%d posts',$_smarty_tpl->tpl_vars['loaded_post_count']->value);?>
&nbsp;<?php echo _w('of %d post','of %d posts',$_smarty_tpl->tpl_vars['post_count']->value);?>

            <br>
            <a href="?page=<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
" class="pageless-link">Показать более ранние записи</a>
            <div class="pageless-progress" style="display:none;"><i class="icon16 loading"></i>Загрузка...</div>
        <?php }elseif(isset($_smarty_tpl->tpl_vars['page']->value)&&$_smarty_tpl->tpl_vars['pages']->value){?>
            <?php echo _w('%d post','%d posts',$_smarty_tpl->tpl_vars['post_count']->value);?>

        <?php }?>

        </div>
    <?php }?>

<?php if (!$_smarty_tpl->tpl_vars['is_lazyloading']->value){?>
</div>
<ul class="menu-h" id="stream-paging">
    <?php $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['p']->step = 1;$_smarty_tpl->tpl_vars['p']->total = (int)ceil(($_smarty_tpl->tpl_vars['p']->step > 0 ? $_smarty_tpl->tpl_vars['pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['pages']->value)+1)/abs($_smarty_tpl->tpl_vars['p']->step));
if ($_smarty_tpl->tpl_vars['p']->total > 0){
for ($_smarty_tpl->tpl_vars['p']->value = 1, $_smarty_tpl->tpl_vars['p']->iteration = 1;$_smarty_tpl->tpl_vars['p']->iteration <= $_smarty_tpl->tpl_vars['p']->total;$_smarty_tpl->tpl_vars['p']->value += $_smarty_tpl->tpl_vars['p']->step, $_smarty_tpl->tpl_vars['p']->iteration++){
$_smarty_tpl->tpl_vars['p']->first = $_smarty_tpl->tpl_vars['p']->iteration == 1;$_smarty_tpl->tpl_vars['p']->last = $_smarty_tpl->tpl_vars['p']->iteration == $_smarty_tpl->tpl_vars['p']->total;?>
        <li<?php if ($_smarty_tpl->tpl_vars['p']->value==$_smarty_tpl->tpl_vars['page']->value){?> class="selected"<?php }?>><a href="<?php if ($_smarty_tpl->tpl_vars['p']->value==$_smarty_tpl->tpl_vars['page']->value){?>#page_<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
<?php }else{ ?>?page=<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
<?php }?>"><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a></li>
    <?php }} ?>
</ul>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value==1&&!$_smarty_tpl->tpl_vars['wa']->value->globals('disable_pageless')){?>
<script type="text/javascript">
$.pageless({
        auto: true, // auto load next pages
        url: '?layout=lazyloading',
        target: '.lazyloading:first',
        scroll: function(response){
            var progress = '';
            if (response) {
                progress = '<i class="icon16 loading"><'+'/i> <em>Загрузка...<'+'/em>';
            }
        },
        count: <?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
,
        paging_selector:'#stream-paging'
});
</script>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:37:13
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream_search.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0e9190f2e23_89889207')) {function content_59b0e9190f2e23_89889207($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.truncate.php';
?>

<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
<div class="post search-match" id="post-<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['wa']->value->param('blog_url')){?>itemprop="blogPosts"<?php }?> itemscope itemtype="http://schema.org/BlogPosting">
            <h3><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" itemprop="url"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h3>
    <span class="hint">
        <?php if ($_smarty_tpl->tpl_vars['post']->value['user']['posts_link']){?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['posts_link'];?>
" class="username" rel="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</a>
        <?php }else{ ?>
            <span class="username" rel="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</span>
        <?php }?>
        <?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],"humandate");?>

    </span>
    <p>
        <?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['text']),400);?>

    </p>
</div>
<?php }
if (!$_smarty_tpl->tpl_vars['post']->_loop) {
?>
    <?php if (!isset($_smarty_tpl->tpl_vars['page']->value)||$_smarty_tpl->tpl_vars['page']->value<2){?>
        <?php echo _w('%d post','%d posts',0);?>

    <?php }?>
<?php } ?><?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:37:13
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/stream_posts.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0e91915df34_99053167')) {function content_59b0e91915df34_99053167($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?>

<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
    <div class="post" id="post-<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['wa']->value->param('blog_url')){?>itemprop="blogPosts" <?php }?>itemscope itemtype="http://schema.org/BlogPosting">
        <h3>
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" itemprop="url"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>

            
            <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['plugins']['post_title'])){?>
                <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['post_title']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
            <?php }?>

        </h3>
        <div class="credentials">

            <?php if (isset($_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'])){?>
                <?php if ($_smarty_tpl->tpl_vars['post']->value['user']['posts_link']){?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['posts_link'];?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" class="userpic" alt="">
                    </a>
                <?php }else{ ?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" class="userpic" alt="">
                <?php }?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['post']->value['user']['posts_link']){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['posts_link'];?>
" class="username" rel="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</a>
            <?php }else{ ?>
                <span class="username" rel="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</span>
            <?php }?>
            <span class="hint date"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],"humandate");?>
</span>
            <?php if ($_smarty_tpl->tpl_vars['show_comments']->value&&$_smarty_tpl->tpl_vars['post']->value['comments_allowed']){?>
            	<?php if (!empty($_smarty_tpl->tpl_vars['post']->value['comment_count'])){?>
            	    <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
#comments" class="small">
        	            <?php echo _w('%d comment','%d comments',$_smarty_tpl->tpl_vars['post']->value['comment_count']);?>

    	            </a>
                <?php }else{ ?>
                	<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
#comments" class="hint">
                    	нет комментариев
	                </a>
                <?php }?>
            <?php }?>

        </div>

        
        <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['plugins']['before'])){?>
            <div class="text_before">
                <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['before']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
            </div>
        <?php }?>

        <div class="text">
            <?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>

            <?php if ($_smarty_tpl->tpl_vars['post']->value['cutted']){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['post']->value['cut_link_label'])===null||$tmp==='' ? 'Читать далее →' : $tmp);?>
</a>
            <?php }?>
        </div>
        
        
        <?php if ($_smarty_tpl->tpl_vars['post']->value['album_id']&&$_smarty_tpl->tpl_vars['post']->value['album']['id']&&$_smarty_tpl->tpl_vars['post']->value['album']['photos']){?>
            <?php $_smarty_tpl->tpl_vars['photos_loaded'] = new Smarty_variable(1, null, 0);?> 
            <div class="photo-album-attachment">
                <ul class="thumbs">
                    <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['album']['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
#photo<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumb_crop']['url'];?>
" class="retinify" width="96" height="96" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"></a></li>
                    <?php } ?>
                </ul>
            </div>
        <?php }?>

        
        <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['plugins']['after'])){?>
            <div class="text_after">
                <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['post']->value['plugins']['after']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
            </div>
        <?php }?>

    </div>
<?php }
if (!$_smarty_tpl->tpl_vars['post']->_loop) {
?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value<2){?>
        <?php echo _w('%d post','%d posts',0);?>

    <?php }?>
<?php } ?>

<?php if (!empty($_smarty_tpl->tpl_vars['photos_loaded']->value)&&blogPhotosBridge::is2xEnabled()){?>
    <script src="<?php echo $_smarty_tpl->tpl_vars['wa_static_url']->value;?>
wa-content/js/jquery-plugins/jquery.retina.min.js"></script>
    <script>$(function() { "use strict";
        $.Retina && $('img.retinify').retina();
    });</script>
<?php }?>
<?php }} ?>