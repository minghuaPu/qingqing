<?php


// 数据库操作父类
// CURD create update recode delete
class pdoClass {

	// 属性
	public $link;
	public $debug=false;
	// 方法
	//  1、连接
	
	// 构造函数
	// 特点一：类一实例化构造函数自动执行 生命周期
	function __construct($dbhost="",$db_user="",$db_pwd="",$debug= false){
		
		$this->debug = $debug;

		$this->link = new PDO($dbhost,$db_user,$db_pwd);
	}

	public function exec($sql)
	{
		 $num = $this->link ->exec($sql);

		 if( $this->link->errorCode() != "00000"){
		 	if ($this->debug == true) {
		 		var_dump($this->link->errorInfo());
		 	}else{
		 		return $this->link->errorInfo();
		 	}
		 }else{
		 		return $num;
		 }
	}

	public function getInsertId()
	{
		 return $this->link->lastInsertId();
	}

	/**
	 * 获取多条记录
	 * @param  string $sql sql语句
	 * @return array      多条记录
	 */
	public function select($sql)
	{
		$pstate = $this->link->prepare($sql);

		$pstate->execute();

		return $pstate->fetchAll();
	}

	public function find($sql)
	{
		$pstate = $this->link->prepare($sql);

		$pstate->execute();

		return $pstate->fetch();
	}

	/**
	 * 删除一条信息
	 * @param  string $table 表名
	 * @param  int $id    主键ID
	 * @return int        受影响的行数
	 */
	function deleteInfo($table,$id)
	{ 
		$delete_sql = "delete from $table where id= $id";

		return $this->exec($delete_sql);
	}

	/**
	 * 获取单条信息，根据主键ID
	 * @param  int $id     主键ID值
	 * @param  string $fileds [成员列表]
	 * @return [array]         [一条记录]
	 */
	public function getInfo($id,$fileds="*")
	{
		  
		 $table = $this->table_name ;
	 	 $select_sql = "select $fileds from $table where id=$id";

		 $pdostatem = $this->link->prepare($select_sql);

		 $pdostatem->execute();

		 return $pdostatem->fetch();
	}
 
	// 2、CURD 增删改查
	
	/**
	 * 添加信息
	 * @param string $table   表名
	 * @param array  $addData 添加的数据
	 * @return int        最近一次添加的记录
	 */
	function addInfo($addData=array())
	{
		//从内存里面释放变量
		unset($addData['type']);
		 $table = $this->table_name ;
		
		 
		$col_str =  implode(",", array_keys($addData));
		
	 
		
		$val_data = array_values($addData);

		$val_str = "";
		$douhao = "";
		foreach ($val_data as $key => $value) {
			 // 怎么判断变量的类型
			 if(is_string($value)){
			 	$val_str.=$douhao."'".$value."'";
			 }else{
			 	$val_str.=$douhao.$value;
			 }
			 $douhao =",";
		}
	 
		 $this->exec("insert into $table ($col_str) values($val_str)");


		return  $this->link->lastInsertId();

	 
	}

 	/**
 	 * 修改信息
 	 * @param  string $table      表名
 	 * @param  array  $updateData 修改的数组
 	 * @param  array  $whereData  条件
 	 * @return int             受影响的行数
 	 */
	function updateInfo($table,$updateData=array(),$whereData=array())
	{

		$set_val_str = '';
		$douhao= '';
		foreach ($updateData as $key => $value) {
			$set_val_str.= $douhao.$key.'='. "'".$value."'";
			$douhao=",";
		}
		

		$where_str = '';
		$douhao= '';
		foreach ($whereData as $key => $value) {
			$where_str.= $douhao.$key.'='. $value;
			$douhao=" and ";
		}
		return  $this->exec("update $table  set  $set_val_str where $where_str");
		
	}

}
 

?>