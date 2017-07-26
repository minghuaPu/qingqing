<?php
/* Smarty version 3.1.30, created on 2017-07-26 06:39:31
  from "D:\wamp64\www\20160728\lesson_6\view\weibo.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59783923d07974_51973783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9f3ca876c8a8905c1370349a337040f4187bd4c' => 
    array (
      0 => 'D:\\wamp64\\www\\20160728\\lesson_6\\view\\weibo.html',
      1 => 1501051170,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59783923d07974_51973783 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>微博例子</title>
	<!-- jquery -->
	<?php echo '<script'; ?>
 type="text/javascript" src="public/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" type="text/css" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="public/css/weibo.css">
	<link rel="stylesheet" type="text/css" href="public/css/animate.css">

	<?php echo '<script'; ?>
 type="text/javascript" src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>
<body>
	<header style="background-color: #666;">
		<div class="container">
			<h2 class="col-lg-8" style="color: #ffff;margin: 15px 0;">微动</h2>
			<div class="col-lg-4 pull-right mt_20 user_status_box">
				<?php if ($_smarty_tpl->tpl_vars['user_name']->value) {?>
				<div class="dropdown">
					<!-- 按钮 -->
					<a  data-toggle="dropdown">
					<!-- default : smarty定义默认值，如果前面的值没有则使用default:后面的 -->
						<img width="28" src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['user_info']->value['head_photo'])===null||$tmp==='' ? '/20160728/lesson_5/weibo_2_1/public/head_photo.jpg' : $tmp);?>
" alt="">
						<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
 ,欢迎你
						<!-- 下拉组件的下拉箭头样式 -->
						<span class="caret"></span>
					</a>

					<!-- 下拉菜单默认的是隐藏 -->
					<ul class="dropdown-menu">
						<li>
							<a href="#photoBox" data-toggle="modal">设置头像</a>
							<a onclick="logout()">退出</a>
						</li>
					</ul>
				</div>
				<?php } else { ?>
				<a href="#loginBox" data-toggle="modal">登录</a>
				|
				<a href="#registerBox" data-toggle="modal">注册</a>
				<?php }?>
			</div>
		</div>
	
		<!-- 上传头像模态框 -->
		<div class="modal" id="photoBox">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">上传头像</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="file" id="headPhoto">
							</div>
	 
						<div class="form-group">
							<input type="button"  onclick="sendPhoto()"  class="btn btn-success" value="上传"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- 登录模态框 -->
		<div class="modal" id="loginBox">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">登录微动</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="">用户名</label>
							<input type="text" id="user_log_name" class="form-control"></div>
						<div class="form-group">
							<label for="">密码</label>
							<input type="text" id="user_log_pwd" class="form-control"></div>

						<div class="form-group">
							<input type="button"  onclick="doLogin()"  class="btn btn-success" value="我要登录"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- 注册模态框 -->
		<div class="modal" id="registerBox">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">欢迎注册微动</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="">用户名</label>
							<input type="text" id="user_name" class="form-control"></div>
						<div class="form-group">
							<label for="">密码</label>
							<input type="text" id="user_pwd" class="form-control"></div>
						<div class="form-group">
							<label for="">重复密码</label>
							<input type="text" id="user_repwd" class="form-control"></div>
						<div class="form-group">
							<input type="button"  onclick="doReg()"  class="btn btn-success" value="我要注册"></div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="container">

		<!-- 动态列表盒子start -->
		<div class="row">
			<div class="col-lg-8">
				<div class="row menu_box">
					<div class="col-lg-3 menu_tab">
						<a href="#tab1" data-toggle="tab">
							<span class="glyphicon glyphicon-pencil"></span>
							文字
						</a>
					</div>
					<div class="col-lg-3 menu_tab">
						<a href="#tab2" data-toggle="tab">
							<span class="glyphicon glyphicon-heart"></span>
							图文
						</a>
					</div>
					<div class="col-lg-3 menu_tab">
						<a href="#tab3" data-toggle="tab">
							<span class="glyphicon glyphicon-music"></span>
							音乐
						</a>
					</div>
					<div class="col-lg-3 menu_tab">
						<span class="glyphicon glyphicon-film"></span>
						视频
					</div>
				</div>

				<form action="post_do.php" method="post">
					<!-- bootstrap定义面板内容盒子的类 tab-content -->
					<div class="tab-content">
						<!-- 第一个面板是放文字发布框 -->
						<!-- bootstrap定义选项卡内容盒子，具体的一个切换框的类是 tab-pane (panel) 
				tab-pane 特点一：默认都是隐藏的，然后需要显示则加上active类即可
						 特点二：可以加动画，都加上fade类，然后给当前面板需加上in类
			-->

						<div class="tab-pane fade in active" id="tab1">
							<textarea name="weibo_content" id="short_content" class="form-control" ></textarea>
						</div>
						<!-- 第二个面板是放图文发布框 -->
						<div class="tab-pane fade" id="tab2">
							<textarea name="weibo_content" id="pic_text" class="form-control" ></textarea>
							<input type="file" id="pic_file"></div>

						<div class="tab-pane fade" id="tab3">
						<input type="text" class="form-control " placehodler="请输入歌曲关键词" onkeyup="searchMusic(this)">
							<div class="preview_box">
								
							</div>
							<ul class="music_list_box">
								
							</ul>

							<input type="file" id="music_file" >音乐</div>
					</div>
					<input type="hidden" id="type" value="short_content">
					<input type="button" class="btn btn-info btn-lg pull-right mt_20" value="发布" onclick="submit_weibo()"></form>

				<div class="clearfix"></div>
				<!-- 动态列表布局：
			获取已经存在的微博内容，把它们列出来
		 -->

				<ul  class="list_box mt_20">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['weibo_list']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
					<li class="clearfix">
						<div class="col-lg-2">
							<img data-uid="<?php echo $_smarty_tpl->tpl_vars['item']->value['uid'];?>
"  src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['head_photo'])===null||$tmp==='' ? '/20160728/lesson_5/weibo_2_1/public/head_photo.jpg' : $tmp);?>
"  class="head_photo head_photo_box"></div>

						<div class="col-lg-10 content_box">
							<div class="sanjiao_box"></div>

							<div class="list_content">
								<?php if ($_smarty_tpl->tpl_vars['item']->value['type'] == 'music') {?>
								<img src="<?php echo $_smarty_tpl->tpl_vars['item']->value['pic'];?>
" style="width:88px" alt="">
								<audio src="<?php echo $_smarty_tpl->tpl_vars['item']->value['music'];?>
" controls></audio>
								<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type'] == 'pic_text') {?>
								<div class="col-lg-6">
									<img  style="width:100%" src="<?php echo $_smarty_tpl->tpl_vars['item']->value['pic'];?>
" ></div>
								<div class="col-lg-6"><?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_content'];?>
</div>
								<?php } else { ?>	
										<?php echo $_smarty_tpl->tpl_vars['item']->value['weibo_content'];?>
 
									<?php }?>
							</div>
							<div class="mananga_box">
								<a  class="commont_btn" data-num="<?php echo $_smarty_tpl->tpl_vars['item']->value['num'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
									评论(
									<span class="num_val_box"><?php echo $_smarty_tpl->tpl_vars['item']->value['num'];?>
</span>
									)
								</a>
								<?php if ($_smarty_tpl->tpl_vars['uid']->value == $_smarty_tpl->tpl_vars['item']->value['uid']) {?>
								<a href="#modal_box" class="delWeiboBox" data-toggle="modal" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">删除</a>
								<?php }?>
							</div>

							<div class="commont_form_box hide_box">
								<ul class="commont_list"></ul>
								<textarea name=""  class="commont_texarea"  style="width:100%"></textarea>
								<input type="button" class="btn btn-default send_commont" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="发布评论"></div>

						</div>
					</li>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

				</ul>

			</div>
			<div class="col-lg-4 mt_20">广告图片</div>
		</div>
		<!-- 动态列表盒子end -->

	</div>

	<!-- 模态框 -->
	<div class="modal fade" id="modal_box">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- 顶部 -->
				<div class="modal-header">删除信息</div>
				<!-- body -->
				<div class="modal-body">确定删除这条信息吗？</div>
				<!-- 底部 -->
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">取消</button>
					<input type="hidden" id="modal_weibo_id" value="">
					<button class="btn btn-info" onclick="delWeibo()">确定</button>
				</div>
			</div>
		</div>
	</div>

	<div class="head_show_box" style="">
		
	</div>
	<?php echo '<script'; ?>
 type="text/javascript" src="public/js/weibo.js?0.0.4"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
