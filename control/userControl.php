<?php

/**
 * 用户控制器子类
 */
class  userControl extends baseControl{

	public function index()
	{
		echo "用户控制器子类";
		$this->display("user.html");
	}

	//注册
	public function add()
	{

		 // 注册
		 $_POST['create_time'] = time();
		 $uid = $this->model("user")->addInfo($_POST);

		// 获取最近一次添加的自增长ID
		// $pdo->lastInsertId();

		// 注册成功后，把信息存到会话
		// 预定义变量
		// 开启 使用session_start
		session_start();
		$_SESSION['uid'] =$uid ;
		$_SESSION['user_name'] = $_POST['user_name'] ;


		echo json_encode(array('status'=>1,'uid'=>$uid));
	}

	//登录
	public function login()
	{
		$user_name = $_POST['user_name'];
		$user_pwd = $_POST['user_pwd'];

		$usr_info = $this->model("user")->getUserInfo($user_name,$user_pwd);

		if (empty($usr_info)) {
			echo json_encode(array('status'=>0,'msg'=>"用户名和密码不正确"));
		}else{
				session_start();
				$_SESSION['uid'] =$usr_info['id'] ;
				$_SESSION['user_name'] = $usr_info['user_name'] ;
			echo json_encode(array('status'=>1,'msg'=>"登录成功",'info'=>$usr_info));
		}
	}

	// 退出
	public function logout()
	{
			// 退出
		unset($_SESSION['uid']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_info']);
	}
	
}

?>