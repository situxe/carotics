<?php /* Smarty version Smarty-3.1.14, created on 2017-09-07 11:37:13
         compiled from "/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/content.html" */ ?>
<?php /*%%SmartyHeaderCode:104816125359b0e919989342-88492897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '360cdfeddf0e83cddd3321b51584cd2815f6b4a0' => 
    array (
      0 => '/var/www/dev/data/www/ss6-dev.caroptics.ru/wa-apps/blog/themes/caroptics/content.html',
      1 => 1417705469,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104816125359b0e919989342-88492897',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wa' => 0,
    'settlement_one_blog' => 0,
    'blog_pages' => 0,
    'action' => 0,
    'blogs' => 0,
    'is_search' => 0,
    'blog' => 0,
    'timeline' => 0,
    'year' => 0,
    'item' => 0,
    'wa_app_url' => 0,
    'blog_query' => 0,
    'page_id' => 0,
    'p' => 0,
    'frontend_action' => 0,
    'output' => 0,
    'posts' => 0,
    'wa_backend_url' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_59b0e919ae7a52_53605978',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59b0e919ae7a52_53605978')) {function content_59b0e919ae7a52_53605978($_smarty_tpl) {?>		<?php $_smarty_tpl->tpl_vars['blog_pages'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->pages(), null, 0);?>
		<?php if (!$_smarty_tpl->tpl_vars['settlement_one_blog']->value||$_smarty_tpl->tpl_vars['blog_pages']->value){?>
			<!-- navigation bar -->
			<div class="hero superhero" id="blog-nav">
    	        <ul class="menu-h">
        	        <?php if (!$_smarty_tpl->tpl_vars['settlement_one_blog']->value||$_smarty_tpl->tpl_vars['action']->value=='post'){?>
        	        
        	        	<!-- blog list -->

                        <?php $_smarty_tpl->tpl_vars['blogs'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->blogs(), null, 0);?>
                        <?php if (count($_smarty_tpl->tpl_vars['blogs']->value)>1){?>
                            <li class="<?php if (is_array($_smarty_tpl->tpl_vars['wa']->value->globals('blog_id'))&&empty($_smarty_tpl->tpl_vars['is_search']->value)){?>selected<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->blog->url();?>
">Все записи</a></li>
                            <?php  $_smarty_tpl->tpl_vars['blog'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blog']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blogs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blog']->key => $_smarty_tpl->tpl_vars['blog']->value){
$_smarty_tpl->tpl_vars['blog']->_loop = true;
?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['wa']->value->globals('blog_id')==$_smarty_tpl->tpl_vars['blog']->value['id']&&empty($_smarty_tpl->tpl_vars['is_search']->value)){?>selected<?php }?>">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['blog']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['blog']->value['name'];?>
</a>
                                </li>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php $_smarty_tpl->tpl_vars['blog'] = new Smarty_variable(current($_smarty_tpl->tpl_vars['blogs']->value), null, 0);?>
                            <li<?php if (empty($_smarty_tpl->tpl_vars['is_search']->value)){?> class="selected"<?php }?>>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['wa']->value->blog->url();?>
"><?php echo $_smarty_tpl->tpl_vars['blog']->value['name'];?>
</a>
                            </li>
                        <?php }?>
                        
                        <?php $_smarty_tpl->tpl_vars['timeline'] = new Smarty_variable($_smarty_tpl->tpl_vars['wa']->value->blog->timeline(), null, 0);?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['timeline']->value)){?>
                        	<!-- timeline navigation -->
	                    	<li id="timeline" class="dropdown">
		                    	<a href="#" class="inline-link">
    		                		<b><i>Календарь</i></b><i class="icon10 darr"></i>
    	    	            	</a>
	    	    	            <?php if (!empty($_smarty_tpl->tpl_vars['timeline']->value)){?>
	    	    	            	<div class="popup">
        							<ul class="menu-v">
            						<?php $_smarty_tpl->tpl_vars['year'] = new Smarty_variable(null, null, 0);?>
            						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['year_month'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['timeline']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['year_month']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
?>
                						<?php if ($_smarty_tpl->tpl_vars['year']->value!=$_smarty_tpl->tpl_vars['item']->value['year']){?>
                    						<?php if (!$_smarty_tpl->tpl_vars['item']->first){?>
					    	                        </ul>
						                        </li>
						                    <?php }?>
					    	                <li <?php if ($_smarty_tpl->tpl_vars['item']->value['year_selected']){?>class="selected"<?php }?>>
					        	            <?php $_smarty_tpl->tpl_vars['year'] = new Smarty_variable($_smarty_tpl->tpl_vars['item']->value['year'], null, 0);?>
					            	        <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['year_link'];?>
"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['year'])===null||$tmp==='' ? 'NULL' : $tmp);?>
</a>
                    						<ul class="menu-v">
						                <?php }?>
						                <li <?php if ($_smarty_tpl->tpl_vars['item']->value['selected']){?>class="selected"<?php }?>>
						                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" title="<?php echo _w("%d post","%d posts",$_smarty_tpl->tpl_vars['item']->value['count']);?>
"><?php echo _ws(date("F",gmmktime(0,0,0,$_smarty_tpl->tpl_vars['item']->value['month'],1)));?>
</a>
						                </li>
									    <?php if ($_smarty_tpl->tpl_vars['item']->last){?>
									            </ul>
								    	    </li>
							            <?php }?>
						            <?php } ?>
							        </ul>
							        </div>
							    <?php }?>
	                    	</li>
    	            	<?php }?>
    	            <?php }?>

                    <!-- search -->
                    <li class="float-right">            	
                        <form method="get" action="<?php echo $_smarty_tpl->tpl_vars['wa_app_url']->value;?>
" class="search">
                            <div class="search-wrapper">
                                <input type="search" name="query" <?php if (!empty($_smarty_tpl->tpl_vars['blog_query']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['blog_query']->value;?>
"<?php }?> placeholder="Найти запись">
                            </div>
                            <div class="clear-both"></div>
                        </form>
                    </li>
                	
                	<!-- static page list -->
         	        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['blog_pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
            	        <li class="float-right<?php if (isset($_smarty_tpl->tpl_vars['page_id']->value)&&$_smarty_tpl->tpl_vars['page_id']->value==$_smarty_tpl->tpl_vars['p']->value['id']){?> selected<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['p']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['name'];?>
</a></li>
                	<?php } ?>
    
                	<!-- plugins -->
					
					<?php if ($_smarty_tpl->tpl_vars['frontend_action']->value){?>
						<li class="dropdown">
							<a href="#" class="inline-link">
   		                		<b><i>Еще</i></b><i class="icon10 darr"></i>
   	    	            	</a>
   	    	            	<div class="popup">
								<?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_action']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
								    <?php if (!empty($_smarty_tpl->tpl_vars['output']->value['sidebar'])){?><?php echo $_smarty_tpl->tpl_vars['output']->value['sidebar'];?>
<?php }?>
								<?php } ?>
							</div>
						</li>
					<?php }?>

	            </ul>
	            
	            <div class="clear-both"></div>
	            
			</div>
		<?php }?>

		<!-- blog content -->
		
    	<?php  $_smarty_tpl->tpl_vars['output'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['output']->_loop = false;
 $_smarty_tpl->tpl_vars['plugin'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['frontend_action']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['output']->key => $_smarty_tpl->tpl_vars['output']->value){
$_smarty_tpl->tpl_vars['output']->_loop = true;
 $_smarty_tpl->tpl_vars['plugin']->value = $_smarty_tpl->tpl_vars['output']->key;
?>
        	<?php if (!empty($_smarty_tpl->tpl_vars['output']->value['nav_before'])){?><?php echo $_smarty_tpl->tpl_vars['output']->value['nav_before'];?>
<?php }?>
        <?php } ?>
            
        <?php if (empty($_smarty_tpl->tpl_vars['posts']->value)&&$_smarty_tpl->tpl_vars['wa']->value->currentUrl()==$_smarty_tpl->tpl_vars['wa_app_url']->value){?>

            <div class="welcome">
                <h1>Добро пожаловать в ваш новый блог!</h1>
                <p><?php echo sprintf('Начните с <a href="%s">создания записи</a> в бекенде блога.',($_smarty_tpl->tpl_vars['wa_backend_url']->value).('blog/'));?>
</p>
            </div>
        
        <?php }else{ ?>
        
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>
 
            
        <?php }?><?php }} ?>