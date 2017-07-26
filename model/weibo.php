<?php 
// 微博操作数据库的类

// 子类
// 
// 继承 extends
// 
// 特点：1、继承的父类也会自动执行构造函数
// 		2、无需再写这一个相同类集合的方法

class  weibo  extends pdoClass {

	protected $table_name = 'weibo_detailed';
	
	//获取微博列表
	public function getList($page="0,10")
	{
		$sql ="select * from weibo_detailed   order by id desc  limit $page";
		 
		return $this->select($sql); 
	}
	 
	//获取用户最近几天数据
	public function getLastInfo($uid,$page=3)
	{

		$sql ="select * from weibo_detailed where uid=$uid order by id desc  limit $page";
		 
		return $this->select($sql); 


	}


	public function setContent($new_content)
	{
		$weibo_content = $new_content['weibo_content'];
		$pic = $new_content['pic'];
		$type = $new_content['type'];
		$music = $new_content['music'];
		$create_time = time();

		$uid = $_SESSION['uid'];
		 

	  	// mysql添加
	  	// 添加语法：insert into 表名 (字段1,字段2,字段3) values (整型值1,'字符串1')
	  	$inesrt_sql = "insert into weibo_detailed(weibo_content,pic,create_time,type,music,uid) values('$weibo_content','$pic',$create_time,'$type','$music',$uid)";

	// 执行一条语句
	  	$num = $this->exec($inesrt_sql);

	  	return  array(
			'num' => $num,
			'id' => $this->getInsertId()
		);
	}

}


 ?>