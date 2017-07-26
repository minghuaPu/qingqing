<?php

// 微博控制器
// 里面的方法叫作行为
class  weiboControl extends baseControl{


	public function index()
	{

		if ($_SESSION['uid']>0) {

			$user_info = $this->model("user")->getInfo($_SESSION['uid'],'head_photo');
			$this->assign("user_info",$user_info);

			$_SESSION['user_info'] = $user_info;

			 

			$this->assign("user_name",$_SESSION['user_name']);

			$this->assign("uid",$_SESSION['uid']);

		}

		$weibo_list = $this->model("weibo")->getList();

		$this->assign('weibo_list',$weibo_list);

		$this->display("weibo.html");
	}
	//长微博
	public function send_long()
	{ 
		$this->display("weibo_long.html");
	}

	// 保存长尾巴操作
	public function save()
	{
		
		$this->model("weibo")->addInfo(array("weibo_content"=>$_POST['weibo_content']));
	
	}


	//获取最近几条信息
	public function getLastInfo()
	{
		 

		$weibo_list= $this->model("weibo")->getLastInfo($_REQUEST['uid']);
		

		echo json_encode($weibo_list);
	}


	// 发布微博
	
	public function sendWeibo()
	{
		$new_content['weibo_content'] =  $_POST['weibo_content'];
		$new_content['type'] = $_POST['type'];

		// 保存这一条微博信息
		// 问题一：内容会被覆盖
		
		
	  	$error_array = $this->model('weibo')->setContent($new_content);

	  	if ($error_array['num'] >0){
	  		
			$this->assign("uid",$_SESSION['uid']);
			$this->assign("user_info",$_SESSION['user_info']);


			$new_content['id'] = $error_array['id'];
			$this->assign("item",$new_content);

			// html编码统一返回null
			$html = $this->fetch("list_content.html");

	        echo json_encode(
	            array(
	                "status"=>1,
	                "msg"=>'发布成功',
	                "html"=>$html
	            )
	        );
	    }else{
	        echo json_encode(
	            array(
	                "status"=>0,
	                "msg"=>'发布失败',
	                "error_info"=>$error_array['info'][2]
	            )
	        );
	    }
	}



}

?>