<?php 
// 用户操作数据库的类
// 
// 面向对象 ：父类调用子类的属性
// 


class  user  extends pdoClass {

	protected $table_name = "weibo_user";

	function getUserInfo($user_name,$user_pwd){

		return  $this->find("SELECT id,user_name  FROM  weibo_user WHERE user_name='$user_name' and user_pwd='$user_pwd' ");
		 
	}

}


 ?>