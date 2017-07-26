<?php
/* Smarty version 3.1.30, created on 2017-07-26 08:27:56
  from "D:\wamp64\www\20160728\lesson_6\view\list_content.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5978528c334132_54262861',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bb934ecb93a6e238869689cede453d27774d633' => 
    array (
      0 => 'D:\\wamp64\\www\\20160728\\lesson_6\\view\\list_content.html',
      1 => 1501057655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5978528c334132_54262861 (Smarty_Internal_Template $_smarty_tpl) {
?>
<li class="clearfix animated slideInDown">
	<div class="col-lg-2">
		<img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['user_info']->value['head_photo'])===null||$tmp==='' ? '/20160728/lesson_5/weibo_2_1/public/head_photo.jpg' : $tmp);?>
" alt=""   class="head_photo"></div>

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
			<a  class="commont_btn" data-num="0" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
				评论(
				<span class="num_val_box">0</span>
				)
			</a>
			<a href="#modal_box" data-toggle="modal">删除</a>
		</div>

		<div class="commont_form_box hide_box">
			<ul class="commont_list"></ul>
			<textarea name=""  class="commont_texarea"  style="width:100%"></textarea>
			<input type="button" class="btn btn-default send_commont" data-id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="发布评论"></div>

	</div>
</li><?php }
}
