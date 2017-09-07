<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:46:52
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/post.html" */ ?>
<?php /*%%SmartyHeaderCode:104191989859b0eb5c2d8d36-08212118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0a64f01cf49ea735de59ea19fa02266fac6860f' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/post.html',
      1 => 1419597236,
      2 => 'file',
    ),
    '7d7fdfb1c26789fc3e6b4a1b9a375350a4b6f986' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/post.album.html',
      1 => 1419597236,
      2 => 'file',
    ),
    '9437c7ad2f0427a6efa7f9d299eee89ae339aac6' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/comment.html',
      1 => 1382096802,
      2 => 'file',
    ),
    '64c65bf41b7de541a327d5c0ede94cdaaec2b2fc' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/comments.html',
      1 => 1427265803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104191989859b0eb5c2d8d36-08212118',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'output' => 0,
    'frontend_post' => 0,
    'show_comments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0eb5c62b1f9_20036168',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0eb5c62b1f9_20036168')) {function content_59b0eb5c62b1f9_20036168($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?>

<div itemscope itemtype="http://schema.org/BlogPosting">

    <div class="post" role="main" id="post-<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
">
        <h1 itemprop="name">
            <?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>


            
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
        </h1>

        <div class="credentials">
            <?php if ($_smarty_tpl->tpl_vars['post']->value['contact_id']){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['posts_link'];?>
">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" class="userpic" alt="">
                </a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['posts_link'];?>
" class="username" rel="author" itemprop="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</a>
            <?php }else{ ?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['user']['photo_url_20'];?>
" class="userpic" alt="">
                <span class="username" rel="author" itemprop="author"><?php echo $_smarty_tpl->tpl_vars['post']->value['user']['name'];?>
</span>
            <?php }?>
            <meta itemprop="datePublished" content="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['datetime'],'Y-m-d\TH:i');?>
">
            <span class="hint date" title="<?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime']);?>
"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['post']->value['datetime'],"humandate");?>
</span>
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

        <div class="text" itemprop="articleBody">
            <?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>

        </div>

        <?php if ($_smarty_tpl->tpl_vars['post']->value['album_id']&&$_smarty_tpl->tpl_vars['post']->value['album']['id']&&$_smarty_tpl->tpl_vars['post']->value['album']['photos']){?>
            <?php /*  Call merged included template "post.album.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('post.album.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('album'=>$_smarty_tpl->tpl_vars['post']->value['album']), 0, '104191989859b0eb5c2d8d36-08212118');
content_59b0eb5c3956c9_72595057($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "post.album.html" */?>
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

    
    <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_post']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
        <?php if (!empty($_smarty_tpl->tpl_vars['output']->value['footer'])){?><?php echo $_smarty_tpl->tpl_vars['output']->value['footer'];?>
<?php }?>
    <?php } ?>

    <?php if ($_smarty_tpl->tpl_vars['show_comments']->value&&$_smarty_tpl->tpl_vars['post']->value['comments_allowed']){?>
        <?php if ($_smarty_tpl->tpl_vars['post']->value['status']==blogPostModel::STATUS_PUBLISHED){?>
            <?php /*  Call merged included template "comments.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('comments.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '104191989859b0eb5c2d8d36-08212118');
content_59b0eb5c4222b7_61646355($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "comments.html" */?>
        <?php }else{ ?>
            <h4>Комментарии к записям-черновикам отключены</h4>
        <?php }?>
    <?php }?>

</div>
<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:46:52
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/post.album.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0eb5c3956c9_72595057')) {function content_59b0eb5c3956c9_72595057($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['post']->value['album']['photos']){?>
    <div class="photo-album-attachment">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['album']['photos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
            <figure itemscope itemtype ="http://schema.org/Photograph" class="photo">
                <?php if ($_smarty_tpl->tpl_vars['p']->value['description']){?>
                    <?php if (strstr($_smarty_tpl->tpl_vars['p']->value['description'],'<p>')){?>
                        <div itemprop="description"><?php echo $_smarty_tpl->tpl_vars['p']->value['description'];?>
</div>
                    <?php }else{ ?>
                        <p itemprop="description"><?php echo $_smarty_tpl->tpl_vars['p']->value['description'];?>
</p>
                    <?php }?>
                <?php }?>
                <a name="photo<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
"></a>
                <img src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumb_big']['url'];?>
" class="retinify" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
            </figure>
        <?php } ?>
    </div>

    <?php if (blogPhotosBridge::is2xEnabled()){?>
        <script>$(function() { "use strict";
            if ($.Retina) {
                retinify();
            } else {
                $.ajax({ // Load JS script, making sure it WILL get cached in non-debug mode
                      dataType: "script",
                      url: "<?php echo $_smarty_tpl->tpl_vars['wa_url']->value;?>
wa-content/js/jquery-plugins/jquery.retina.min.js?<?php echo $_smarty_tpl->tpl_vars['wa']->value->version(true);?>
",
                      cache: true
                }).done(retinify);
            }

            function retinify() {
                $.Retina && $('img.retinify').retina();
            }
        });</script>
    <?php }?>
<?php }?>

<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:46:52
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/comments.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0eb5c4222b7_61646355')) {function content_59b0eb5c4222b7_61646355($_smarty_tpl) {?>

<script type="text/javascript">
$(document).ready(function() {
    var provider_list = $('#user-auth-provider');
    
    provider_list.find('a').click(function () {
        var self = $(this);
        var provider = self.parents('li:first').attr('data-provider');
        
        if (provider != 'guest' && provider != 'signup') {
            var left = (screen.width-600)/2;
            var top = (screen.height-400)/2;
            window.open($(this).attr('href')<?php if (!$_smarty_tpl->tpl_vars['require_authorization']->value){?> + "&guest=1"<?php }?>,'oauth', "width=600,height=400,left="+left+",top="+top+",status=no,toolbar=no,menubar=no");
            return false;
        }
    })
});
</script>


<div class="comments" itemscope itemtype="http://schema.org/UserComments">
    <a name="comments"></a>
        <h3 class="comment-count" <?php if ($_smarty_tpl->tpl_vars['post']->value['comment_count']==0){?>style="display: none;"<?php }?>><?php echo _w('%d comment','%d comments',$_smarty_tpl->tpl_vars['post']->value['comment_count']);?>
</h3>

        <?php if ($_smarty_tpl->tpl_vars['post']->value['comment_count']==0){?>
            <ul class="menu-v with-icons">
                <!-- placeholder for new comments -->
            </ul>
        <?php }?>


        <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable(-1, null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['comment']->value['depth']<$_smarty_tpl->tpl_vars['depth']->value){?>
                <?php $_smarty_tpl->tpl_vars['loop'] = new Smarty_variable($_smarty_tpl->tpl_vars['depth']->value-$_smarty_tpl->tpl_vars['comment']->value['depth'], null, 0);?>
                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['name'] = "end-comment";
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['loop']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total']);
?>

                        </li>
                    </ul>
                <?php endfor; endif; ?>
                <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable($_smarty_tpl->tpl_vars['comment']->value['depth'], null, 0);?>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['comment']->value['depth']==$_smarty_tpl->tpl_vars['depth']->value){?>

                </li>
                <li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['comment']->value['depth']>$_smarty_tpl->tpl_vars['depth']->value){?>

            <ul class="menu-v with-icons">
                <li>
                <?php $_smarty_tpl->tpl_vars['depth'] = new Smarty_variable($_smarty_tpl->tpl_vars['comment']->value['depth'], null, 0);?>
            <?php }?>

            <?php /*  Call merged included template "comment.html" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("comment.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '104191989859b0eb5c2d8d36-08212118');
content_59b0eb5c48dda3_85966258($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "comment.html" */?>
            
        <?php } ?>
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['name'] = "end-comment";
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['depth']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["end-comment"]['total']);
?>

                    </li>
                </ul>
        <?php endfor; endif; ?>
        </li>
    </ul>


</div>
<div class="comment-form">
    <a name="comment0"></a>
    <form action="<?php echo $_smarty_tpl->tpl_vars['post']->value['comment_link'];?>
" method="post">
        <h4>Написать комментарий</h4>
        <?php $_smarty_tpl->tpl_vars['current_user_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->userId(), null, 0);?>

        <div class="comment-form-fields">
            <?php if (empty($_smarty_tpl->tpl_vars['current_user_id']->value)){?>
                <?php if ($_smarty_tpl->tpl_vars['require_authorization']->value){?>
                <div id="user-auth-provider" data-provider="signup" <?php if ($_smarty_tpl->tpl_vars['current_auth_source']->value!='signup'){?>style="display:none"<?php }?>>
                    <?php echo sprintf('Для того, чтобы оставить комментарий, пожалуйста, <a href="%s">зарегистрируйтесь</a> или <a href="%s">авторизуйтесь</a>',$_smarty_tpl->tpl_vars['wa']->value->signupUrl(),$_smarty_tpl->tpl_vars['wa']->value->loginUrl());?>

                </div>
                <?php }elseif($_smarty_tpl->tpl_vars['auth_adapters']->value){?>
                    <ul class="menu-h auth-type" id="user-auth-provider">
                        <?php if ($_smarty_tpl->tpl_vars['require_authorization']->value){?>
                        <li data-provider="signup" <?php if (!$_smarty_tpl->tpl_vars['current_auth_source']->value){?>class="selected"<?php }?>><a href="#">Регистрация</a></li>
                        <?php }else{ ?>
                        <li data-provider="guest" <?php if (!$_smarty_tpl->tpl_vars['current_auth_source']->value){?>class="selected"<?php }?>><a href="#">Гость</a></li>
                        <?php }?>
                        <?php  $_smarty_tpl->tpl_vars['adapter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adapter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['auth_adapters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['adapter']->key => $_smarty_tpl->tpl_vars['adapter']->value){
$_smarty_tpl->tpl_vars['adapter']->_loop = true;
?>
                        <?php $_smarty_tpl->tpl_vars['adapter_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['adapter']->value->getId(), null, 0);?>
                        <li data-provider="<?php echo $_smarty_tpl->tpl_vars['adapter_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['current_auth_source']->value==$_smarty_tpl->tpl_vars['adapter_id']->value){?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['adapter']->value->getCallbackUrl(0);?>
&app=blog"><img src="<?php echo $_smarty_tpl->tpl_vars['adapter']->value->getIcon();?>
" alt=""><?php echo $_smarty_tpl->tpl_vars['adapter']->value->getName();?>
</a></li>
                        <?php } ?>
                    </ul>
                <?php }?>
                <div id="user-auth-provider" class="tab clear-left" data-provider="guest" <?php if ($_smarty_tpl->tpl_vars['current_auth_source']->value){?>style="display:none"<?php }?>>
                    <p>
                        <label for="comment_name">Ваше имя</label>
                        <input type="text" name="name" id="comment_name" class="bold" value="">
                    </p>
                    <p>
                        <label for="comment_email">Email</label>
                        <input type="text" name="email" id="comment_email">
                    </p>
                    <p>
                        <label for="comment_site">Сайт</label>
                        <input type="text" name="site" id="comment_site">
                    </p>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['require_authorization']->value){?>
                <div class="tab" data-provider="signup" <?php if ($_smarty_tpl->tpl_vars['current_auth_source']->value!='signup'){?>style="display:none"<?php }?>>
                    <?php echo sprintf('Для того, чтобы оставить комментарий, пожалуйста, <a href="%s">зарегистрируйтесь</a> или <a href="%s">авторизуйтесь</a>',$_smarty_tpl->tpl_vars['wa']->value->signupUrl(),$_smarty_tpl->tpl_vars['wa']->value->loginUrl());?>

                </div>
                <?php }?>
                <?php  $_smarty_tpl->tpl_vars['adapter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adapter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['auth_adapters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['adapter']->key => $_smarty_tpl->tpl_vars['adapter']->value){
$_smarty_tpl->tpl_vars['adapter']->_loop = true;
?>
                    <div class="tab" data-provider="<?php echo $_smarty_tpl->tpl_vars['adapter']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['current_auth_source']->value!=$_smarty_tpl->tpl_vars['adapter']->value->getId()){?>style="display:none"<?php }?>>
                        <p>
                            <label for="name">Ваше имя</label>
                            <strong><img src="<?php echo $_smarty_tpl->tpl_vars['adapter']->value->getIcon();?>
" class="userpic" /><?php echo $_smarty_tpl->tpl_vars['current_auth']->value['name'];?>
</strong>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
logout">выйти</a>
                        </p>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <p>
                    <label>Ваше имя</label>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['wa']->value->user()->getPhoto(20);?>
" class="userpic" alt=""> <strong><?php echo $_smarty_tpl->tpl_vars['wa']->value->user('name');?>
</strong> <a href="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
logout">выйти</a>
                </p>
            <?php }?>

            <p class="comment-body">
                <label for="comment_text">Комментарий</label>
                <textarea id="comment_text" name="text" rows="10" cols="45"></textarea>
            </p>
        </div>
        <div class="comment-submit">
            <?php if ($_smarty_tpl->tpl_vars['request_captcha']->value&&empty($_smarty_tpl->tpl_vars['current_user_id']->value)){?>
                <?php echo $_smarty_tpl->tpl_vars['wa']->value->captcha();?>

            <?php }?>
            <input type="hidden" name="auth_provider" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['current_auth_source']->value)===null||$tmp==='' ? blogCommentModel::AUTH_GUEST : $tmp);?>
">
            <input type="hidden" name="parent" value="0">
            <input type="submit" value="Написать комментарий">
            <img src="<?php echo $_smarty_tpl->tpl_vars['wa_static_url']->value;?>
wa-content/img/loading16.gif" style="display: none;" alt="">
        </div>
    </form>
</div>

<?php }} ?><?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:46:52
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/comment.html" */ ?>
<?php if ($_valid && !is_callable('content_59b0eb5c48dda3_85966258')) {function content_59b0eb5c48dda3_85966258($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty3/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_wa_datetime')) include '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-system/vendors/smarty-plugins/modifier.wa_datetime.php';
?>

<div class="comment" id="comment-<?php echo $_smarty_tpl->tpl_vars['comment']->value['id'];?>
">
    <div class="credentials">
        <a name="comment<?php echo $_smarty_tpl->tpl_vars['comment']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['comment']->value['site']){?> href="<?php echo $_smarty_tpl->tpl_vars['comment']->value['site'];?>
"<?php }?>>
            <img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['comment']->value['user']['photo_url_20'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['comment']->value['user']['photo_url'] : $tmp);?>
" class="userpic<?php if ($_smarty_tpl->tpl_vars['comment']->value['auth_provider']&&($_smarty_tpl->tpl_vars['comment']->value['auth_provider']!=blogCommentModel::AUTH_GUEST)&&($_smarty_tpl->tpl_vars['comment']->value['auth_provider']!=blogCommentModel::AUTH_USER)){?> icon16<?php }?>" alt="">
        </a>
        <?php if (empty($_smarty_tpl->tpl_vars['comment']->value['site'])){?>
            <span class="username" itemprop="creator"><?php echo $_smarty_tpl->tpl_vars['comment']->value['name'];?>
</span>
        <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['comment']->value['site'];?>
" class="username" itemprop="creator"><?php echo $_smarty_tpl->tpl_vars['comment']->value['name'];?>
</a>
        <?php }?>

        
        <?php if (!empty($_smarty_tpl->tpl_vars['comment']->value['plugins']['authorname_suffix'])){?>
            <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comment']->value['plugins']['authorname_suffix']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
        <?php }?>

        <meta itemprop="commentTime" content="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['comment']->value['datetime'],'Y-m-d\TH:i');?>
">
        <span class="hint date" title="<?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['comment']->value['datetime']);?>
"><?php echo smarty_modifier_wa_datetime($_smarty_tpl->tpl_vars['comment']->value['datetime'],"humandatetime");?>
</span>
    </div>

    
    <?php if (!empty($_smarty_tpl->tpl_vars['comment']->value['plugins']['before'])){?>
        <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comment']->value['plugins']['before']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
    <?php }?>

    <div class="text" itemprop="commentText"><?php echo nl2br($_smarty_tpl->tpl_vars['comment']->value['text']);?>
</div>

    
    <?php if (!empty($_smarty_tpl->tpl_vars['comment']->value['plugins']['after'])){?>
        <?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comment']->value['plugins']['after']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
<?php } ?>
    <?php }?>

    <div class="actions">
        <a class="inline-link comment-reply" href="#"><b><i>ответить</i></b></a>
    </div>
</div>
<?php }} ?>