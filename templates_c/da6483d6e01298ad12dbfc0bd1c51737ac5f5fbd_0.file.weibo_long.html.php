<?php
/* Smarty version 3.1.30, created on 2017-07-26 03:30:43
  from "D:\wamp64\www\20160728\lesson_6\view\weibo_long.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59780ce38dc478_04451637',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da6483d6e01298ad12dbfc0bd1c51737ac5f5fbd' => 
    array (
      0 => 'D:\\wamp64\\www\\20160728\\lesson_6\\view\\weibo_long.html',
      1 => 1500973253,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59780ce38dc478_04451637 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<?php echo '<script'; ?>
 src="public/js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>

</head>
<body>
	微博列表
	<form action="index.php?action=save" method="post">

		<textarea name="weibo_content" id="baiduEditor"  style="height:280px"></textarea>
		<!-- 配置文件 -->
		<input type="submit" value="发布"></form>
	<?php echo '<script'; ?>
 type="text/javascript" src="public/libarary/ueditor/ueditor.config.js"><?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 type="text/javascript" src="public/libarary/ueditor/ueditor.all.min.js"><?php echo '</script'; ?>
>

	<!-- 实例化编辑器 -->
	<?php echo '<script'; ?>
 type="text/javascript">UE.getEditor("baiduEditor")<?php echo '</script'; ?>
>

</body>
</html><?php }
}
