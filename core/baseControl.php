<?php 
class baseControl{

	// smarty实例化
	
	private  $smarty;
	
	function __construct(){

		$this->smarty = new Smarty();

		$this->smarty->template_dir = "view";
	}

	// 获取子类需要实例化的模型对象
	public function model($model_name)
	{
		 require_once "model/$model_name.php";

		 return  new $model_name("mysql:dbhost=localhost;dbname=mweibo;charset=utf8","root","",true);
	}

	// 显示视图界面
	public function display($html)
	{
		$this->smarty->display($html);
	}

	// 返回smarty编译好的html
	public function fetch($html)
	{
		return $this->smarty->fetch($html);
	}

	// 模版传值
	public function assign($name,$value)
	{
		$this->smarty->assign($name,$value);
	}

	// 入口文件调用
	public function run()
	{
		// 用户模块
		// 加多一个参数：control  决定去哪一个控制器
		// action：去一个控制器里面不同的行为
		 
		$control = isset($_REQUEST['control'])?$_REQUEST['control']:"weibo";//user
		
		$control_name =  $control.'Control';

		require_once "control/$control_name.php";

		$weibo  = new $control_name();

		if (!empty($_REQUEST['action'])) {

			$action = $_REQUEST['action'];
			$weibo ->$action();
		}else{
			$weibo ->index();
		}

	}
}


 ?>